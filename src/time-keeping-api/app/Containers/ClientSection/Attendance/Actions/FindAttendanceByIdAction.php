<?php

namespace App\Containers\ClientSection\Attendance\Actions;

use App\Containers\ClientSection\Attendance\Models\Attendance;
use App\Containers\ClientSection\Attendance\Tasks\FindAttendanceByIdTask;
use App\Containers\ClientSection\Attendance\UI\API\Requests\FindAttendanceByIdRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

final class FindAttendanceByIdAction extends ParentAction
{
    public function __construct(
        private readonly FindAttendanceByIdTask $findAttendanceByIdTask,
    ) {
    }

    public function run(FindAttendanceByIdRequest $request): Attendance
    {
        return $this->findAttendanceByIdTask->run($request->id);
    }
}
