<?php

namespace App\Containers\AdminSection\Network\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

final class UpdateNetworkRequest extends ParentRequest
{
    protected array $decode = [];

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'ip_range_start' => 'sometimes|ip',
            'ip_range_end' => 'sometimes|ip',
            'is_active' => 'sometimes|boolean',
        ];
    }
}
