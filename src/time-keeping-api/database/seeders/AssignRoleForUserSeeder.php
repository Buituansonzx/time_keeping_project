<?php

namespace Database\Seeders;

use App\Containers\AppSection\User\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignRoleForUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assign the 'admin' role to the user with the specified email
        $userEmail = 'bson55444@gmail.com';
        $roleName = 'admin';

        $user = User::where('email', $userEmail)->first();
        if ($user) {
            $user->assignRole($roleName);
            $this->command->info("Assigned role '{$roleName}' to user with email '{$userEmail}'.");
        } else {
            $this->command->error("User with email '{$userEmail}' not found.");
        }

    }
}
