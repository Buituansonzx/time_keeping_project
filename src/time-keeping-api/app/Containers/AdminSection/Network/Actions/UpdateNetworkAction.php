<?php

namespace App\Containers\AdminSection\Network\Actions;

use App\Containers\SharedSection\Network\Models\CompanyNetworkModel;
use App\Ship\Parents\Actions\Action as ParentAction;

final class UpdateNetworkAction extends ParentAction
{
    public function run($networkId, array $data)
    {
        $network = CompanyNetworkModel::findOrFail($networkId);

        $updatableFields = ['name', 'ip_range_start', 'ip_range_end', 'is_active'];
        //Chỉ ghi đè những trường được phép cập nhật
        $fieldsToUpdate = array_intersect_key($data, array_flip($updatableFields));

        if (!empty($fieldsToUpdate)) {
            $network->update($fieldsToUpdate);
        }

        return $network;
    }
}
