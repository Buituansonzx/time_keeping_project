<?php

namespace App\Containers\AdminSection\Network\Actions;

use App\Containers\SharedSection\Network\Models\CompanyNetworkModel;
use App\Ship\Parents\Actions\Action as ParentAction;

final class CreateNetworkAction extends ParentAction
{
    public function run($data)
    {
        $network = CompanyNetworkModel::create([
            'name' => $data['name'],
            'ip_range_start' => $data['ip_range_start'],
            'ip_range_end' => $data['ip_range_end'],
            'is_active' => $data['is_active'] ?? true,
        ]);

        return $network;
    }
}
