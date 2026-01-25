<?php

namespace App\Containers\AdminSection\Network\Actions;

use App\Containers\SharedSection\Network\Models\CompanyNetworkModel;
use App\Ship\Parents\Actions\Action as ParentAction;

final class ListingNetworkAction extends ParentAction
{
    public function run($data)
    {
        $query = CompanyNetworkModel::query();

        if (isset($data['is_active'])) {
            $query->where('is_active', $data['is_active']);
        }

        if (isset($data['search']) && trim($data['search']) !== '') {
            $searchTerm = trim($data['search']);
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('ip_range_start', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('ip_range_end', 'LIKE', "%{$searchTerm}%");
            });
        }

        return $query->paginate($data['per_page'] ?? 15);
    }
}
