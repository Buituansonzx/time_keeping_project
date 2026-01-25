<?php

namespace App\Containers\AdminSection\User\Actions;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;
use Spatie\Permission\Models\Role;

final class CreateUserAction extends ParentAction
{
    public function run($data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'phone_number' => $data['phone'],
            'email_verified_at' => now(),
            ]);
        foreach ($data['roles'] as $roleName) {
            $role = Role::where('name', $roleName)->first();
            if ($role) {
                $user->assignRole($role);
            }
        }
        return $user;
    }
}
