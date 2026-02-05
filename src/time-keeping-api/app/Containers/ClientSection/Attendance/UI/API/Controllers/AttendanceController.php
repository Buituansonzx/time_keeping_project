<?php

namespace App\Containers\ClientSection\Attendance\UI\API\Controllers;

use App\Containers\ClientSection\Attendance\Actions\CheckinAction;
use App\Containers\ClientSection\Attendance\Actions\CheckoutAction;
use App\Ship\Parents\Controllers\ApiController;
use Illuminate\Http\Request;

final class AttendanceController extends ApiController
{
    public function test()
    {
        return response()->json( ['data' => 'pong'] );
    }

    public function checkin(Request $request, CheckinAction $action)
    {
        $fingerprint = $request->header('X-Device-Fingerprint');
        if (app()->environment('production')) {
            // IP thật ngoài production
            $clientIp = $request->ip();
        } else {
            // Local / dev / staging cho phép override IP
            $clientIp = $request->header('X-Company-IP') ?? $request->ip();
        }
        $result = $action->run($fingerprint,$clientIp);
        return response()->json( ['data' => $result] );
    }

    public function checkout(Request $request, CheckoutAction $action)
    {
        $fingerprint = $request->header('X-Device-Fingerprint');
        if (app()->environment('production')) {
            // IP thật ngoài production
            $clientIp = $request->ip();
        } else {
            // Local / dev / staging cho phép override IP
            $clientIp = $request->header('X-Company-IP') ?? $request->ip();
        }
        $result = $action->run($fingerprint,$clientIp);
        return response()->json( ['data' => $result] );
    }
}
