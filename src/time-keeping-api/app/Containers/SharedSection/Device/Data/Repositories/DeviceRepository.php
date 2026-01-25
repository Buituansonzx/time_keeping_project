<?php

namespace App\Containers\SharedSection\Device\Data\Repositories;

use App\Containers\SharedSection\Device\Models\Device;
use App\Ship\Parents\Repositories\Repository as ParentRepository;

/**
 * @template TModel of Device
 *
 * @extends ParentRepository<TModel>
 */
final class DeviceRepository extends ParentRepository
{
    protected $fieldSearchable = [
        // 'id' => '=',
    ];
}
