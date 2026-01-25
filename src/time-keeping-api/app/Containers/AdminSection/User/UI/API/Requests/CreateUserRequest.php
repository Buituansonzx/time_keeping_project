<?php

namespace App\Containers\AdminSection\User\UI\API\Requests;

use App\Ship\Parents\Requests\Request as ParentRequest;

final class CreateUserRequest extends ParentRequest
{
    protected array $decode = [];

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'date_of_birth' => 'required|date',
            'phone' => 'required|string|max:20|unique:users,phone_number',
            'gender' => 'required|string',
            'roles' => 'required|array|exists:roles,name',
            'roles.*' => 'string|exists:roles,name',
        ];
    }
}
