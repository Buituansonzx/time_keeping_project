<?php

namespace App\Containers\SharedSection\Device\Models;

use App\Ship\Parents\Models\Model as ParentModel;

final class Device extends ParentModel
{
     protected $guarded = [];

     protected $table = 'devices';

}
