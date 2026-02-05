<?php

namespace App\Containers\SharedSection\Attendance\Models;

use App\Containers\AppSection\User\Models\User;
use App\Containers\SharedSection\Device\Models\Device;
use App\Ship\Parents\Models\Model as ParentModel;

final class Attendance extends ParentModel
{
    protected $table = 'attendances';

    protected $guarded = [];

    CONST STATUS_VALID = 'valid';
    CONST STATUS_MANUAL = 'manual';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }
}
