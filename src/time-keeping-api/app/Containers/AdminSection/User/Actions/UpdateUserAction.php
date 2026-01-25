<?php

namespace App\Containers\AdminSection\User\Actions;

use App\Containers\AppSection\User\Models\User;
use App\Ship\Parents\Actions\Action as ParentAction;

final class UpdateUserAction extends ParentAction
{
    public function run($userId, array $data)
    {
        $user = User::findOrFail($userId);

        $updatableFields = ['name', 'email', 'date_of_birth', 'gender', 'phone', 'status'];
        //Chỉ ghi đè những trường được phép cập nhật
        $fieldsToUpdate = array_intersect_key($data, array_flip($updatableFields));

        if (!empty($fieldsToUpdate)) {
            $user->update($fieldsToUpdate);
        }

        if (isset($data['roles']) && is_array($data['roles'])) {
            // syncRoles sẽ ghi đè các role cũ
            $user->syncRoles($data['roles']);
        }

        return $user;

    }
}
