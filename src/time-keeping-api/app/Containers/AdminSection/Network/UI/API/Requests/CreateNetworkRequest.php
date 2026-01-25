<?php

namespace App\Containers\AdminSection\Network\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

final class CreateNetworkRequest extends ParentRequest
{
    protected array $decode = [];

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'ip_range_start' => 'required|ip',
            'ip_range_end' => 'required|ip',
            'is_active' => 'sometimes|boolean',
        ];
    }
}
