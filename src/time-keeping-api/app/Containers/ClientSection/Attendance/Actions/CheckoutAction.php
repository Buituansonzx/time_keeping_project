<?php

namespace App\Containers\ClientSection\Attendance\Actions;

use App\Containers\SharedSection\Attendance\Models\Attendance;
use App\Containers\SharedSection\Device\Models\Device;
use App\Ship\Parents\Actions\Action as ParentAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

final class CheckoutAction extends ParentAction
{
    public function run($fingerprint, $clientIp)
    {
        $device = Device::where('fingerprint', $fingerprint)->first();
        if (!$device) {
            throw ValidationException::withMessages([
                'device' => 'Device not registered'
            ]);
        }
        // Lấy ngày hiện tại theo timezone app
        $today = Carbon::now()->toDateString();
        return DB::transaction(function () use ($device, $clientIp, $today) {

            // Lock record "đang mở" để tránh 2 request checkout cùng lúc
            $attendance = Attendance::where('user_id', $device->user_id)
                ->whereDate('check_in_time', $today)
                ->whereNull('check_out_time')
                ->latest('check_in_time')
                ->lockForUpdate()
                ->first();

            if (!$attendance) {
                // Nếu muốn message phân biệt rõ:
                $alreadyCheckedOut = Attendance::where('user_id', $device->user_id)
                    ->whereDate('check_out_time', $today)
                    ->exists();

                throw ValidationException::withMessages([
                    'attendance' => $alreadyCheckedOut
                        ? 'Bạn đã checkout hôm nay rồi'
                        : 'Bạn chưa checkin hôm nay',
                ]);
            }

            $attendance->check_out_time = now();

            $attendance->save();

            return $attendance;
        });
    }
}
