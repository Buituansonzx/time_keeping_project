<?php

namespace App\Containers\ClientSection\Attendance\Tasks;

use App\Containers\ClientSection\Attendance\Data\Repositories\AttendanceRepository;
use App\Containers\ClientSection\Attendance\Models\Attendance;
use App\Ship\Parents\Tasks\Task as ParentTask;

final class UpdateAttendanceTask extends ParentTask
{
    public function __construct(
        private readonly AttendanceRepository $repository,
    ) {
    }

    public function run(array $data, $id): Attendance
    {
        return $this->repository->update($data, $id);
    }
}
