<?php

namespace App\Containers\ClientSection\Attendance\Actions;

use App\Containers\ClientSection\Attendance\Tasks\DeleteAttendanceTask;
use App\Containers\ClientSection\Attendance\UI\API\Requests\DeleteAttendanceRequest;
use App\Ship\Parents\Actions\Action as ParentAction;

final class DeleteAttendanceAction extends ParentAction
{
    public function __construct(
        private readonly DeleteAttendanceTask $deleteAttendanceTask,
    ) {
    }

    public function run(DeleteAttendanceRequest $request): bool
    {
        return $this->deleteAttendanceTask->run($request->id);
    }
}
