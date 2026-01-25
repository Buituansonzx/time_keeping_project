<?php

namespace App\Containers\AdminSection\Network\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

final class ListingNetworkRequest extends ParentRequest
{
    protected array $decode = [];

    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'per_page' => 'nullable|integer|min:1|max:100',
        ];
    }
}
