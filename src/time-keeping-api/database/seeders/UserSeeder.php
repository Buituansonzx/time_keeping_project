<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Containers\AppSection\User\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define five users; one of them uses the requested email.
        $users = [
            [
                'name' => 'Admin Tuan Son',
                'email' => 'bson55444@gmail.com',
                'password' => 'password',
            ],
        ];

        foreach ($users as $u) {
            // skip any entries without an email
            if (empty($u['email'])) {
                continue;
            }

            // Check case-insensitively whether the email already exists
            $exists = User::whereRaw('lower(email) = lower(?)', [$u['email']])->exists();

            if ($exists) {
                // Email already exists - skip creating this user
                continue;
            }

            User::create([
                'name' => $u['name'],
                'email' => $u['email'],
                'password' => Hash::make($u['password']),
                'email_verified_at' => now(),
            ]);
        }
    }
}
