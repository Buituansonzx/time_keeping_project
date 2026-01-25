<?php

namespace App\Containers\ClientSection\Attendance\Actions;

use App\Containers\ClientSection\Attendance\Models\Attendance;
use App\Containers\ClientSection\Attendance\Tasks\CreateAttendanceTask;
use App\Containers\ClientSection\Attendance\UI\API\Requests\CreateAttendanceRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

final class CreateAttendanceAction extends ParentAction
{
    public function __construct(
        private readonly CreateAttendanceTask $createAttendanceTask,
    ) {
    }

    public function run(CreateAttendanceRequest $request): Attendance
    {
        $data = $request->sanitize([
            // add your request data here
        ]);

        return $this->createAttendanceTask->run($data);
    }
}
