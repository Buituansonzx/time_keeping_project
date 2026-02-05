<?php

namespace App\Containers\ClientSection\Attendance\Actions;

use App\Containers\SharedSection\Attendance\Models\Attendance;
use App\Containers\SharedSection\Attendance\Models\DailyWorkSummary;
use App\Containers\SharedSection\Device\Models\Device;
use App\Ship\Parents\Actions\Action as ParentAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

final class CheckinAction extends ParentAction
{
    public function run($fingerprint,$clientIp)
    {
        $device = Device::where('device_fingerprint', $fingerprint)->first();
        if (!$device) {
            throw ValidationException::withMessages([
                'device' => 'Device not registered'
            ]);
        }
        $result = DB::transaction(function () use ($device, $clientIp, &$attendance) {

            $checkinAt = now();

            $alreadyCheckedIn = Attendance::where('user_id', $device->user_id)
                ->whereBetween('check_in_time', [
                    $checkinAt->copy()->startOfDay(),
                    $checkinAt->copy()->endOfDay(),
                ])
                ->lockForUpdate()
                ->exists();

            if ($alreadyCheckedIn) {
                throw ValidationException::withMessages([
                    'attendance' => 'Bạn đã checkin hôm nay rồi',
                ]);
            }

            $attendance = Attendance::create([
                'user_id' => $device->user_id,
                'device_id' => $device->id,
                'check_in_time' => $checkinAt,
                'status' => Attendance::STATUS_VALID,
            ]);

            $scheduledStart = $checkinAt
                ->copy()
                ->startOfDay()
                ->setTimeFromTimeString(config('worktime.start'))
                ->addMinutes((int) config('worktime.grace_period', 0));
            $startReally = $checkinAt
                ->copy()
                ->startOfDay()
                ->setTimeFromTimeString(config('worktime.start'));
            $workResult = $checkinAt->gt($scheduledStart)
                ? DailyWorkSummary::STATUS_LATE
                : DailyWorkSummary::STATUS_NORMAL;

            $dailyWorkSummary =  DailyWorkSummary::updateOrCreate(
                [
                    'user_id' => $device->user_id,
                    'work_date' => $checkinAt->toDateString(),
                ],
                [
                    'work_result' => $workResult,
                    'late_minutes' => $workResult === DailyWorkSummary::STATUS_LATE
                        ? $startReally->diffInMinutes($checkinAt)
                        : 0,
                ]
            );
            return [$attendance, $dailyWorkSummary];
        });
        return $result;
    }
}
