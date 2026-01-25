<?php

namespace App\Containers\ClientSection\Attendance\Actions;

use App\Containers\ClientSection\Attendance\Models\Attendance;
use App\Containers\ClientSection\Attendance\Tasks\UpdateAttendanceTask;
use App\Containers\ClientSection\Attendance\UI\API\Requests\UpdateAttendanceRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

final class UpdateAttendanceAction extends ParentAction
{
    public function __construct(
        private readonly UpdateAttendanceTask $updateAttendanceTask,
    ) {
    }

    public function run(UpdateAttendanceRequest $request): Attendance
    {
        $data = $request->sanitize([
            // add your request data here
        ]);

        return $this->updateAttendanceTask->run($data, $request->id);
    }
}
