<?php

namespace App\Containers\ClientSection\Attendance\Data\Repositories;

use App\Containers\ClientSection\Attendance\Models\Attendance;
use App\Ship\Parents\Repositories\Repository as ParentRepository;

/**
 * @template TModel of Attendance
 *
 * @extends ParentRepository<TModel>
 */
final class AttendanceRepository extends ParentRepository
{
    protected $fieldSearchable = [
        // 'id' => '=',
    ];
}
