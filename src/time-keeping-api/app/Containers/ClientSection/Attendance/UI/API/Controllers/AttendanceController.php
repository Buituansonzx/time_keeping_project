<?php

namespace App\Containers\ClientSection\Attendance\UI\API\Controllers;

use App\Ship\Parents\Controllers\ApiController;

final class AttendanceController extends ApiController
{
    public function test()
    {
        return response()->json( ['data' => 'pong'] );
    }
}
