<?php

namespace App\Containers\SharedSection\Network\Models;

use App\Ship\Parents\Models\Model as ParentModel;

final class CompanyNetworkModel extends ParentModel
{
    protected $table = 'company_networks';

    protected $guarded = [];
}
