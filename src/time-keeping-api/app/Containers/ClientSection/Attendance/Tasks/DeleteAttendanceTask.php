<?php

namespace App\Containers\ClientSection\Attendance\Tasks;

use App\Containers\ClientSection\Attendance\Data\Repositories\AttendanceRepository;
use App\Ship\Parents\Tasks\Task as ParentTask;

final class DeleteAttendanceTask extends ParentTask
{
    public function __construct(
        private readonly AttendanceRepository $repository,
    ) {
    }

    public function run($id): bool
    {
        return $this->repository->delete($id);
    }
}
