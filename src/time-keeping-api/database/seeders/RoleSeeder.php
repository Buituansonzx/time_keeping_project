<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'code' => 'admin'],
            ['name' => 'Manager', 'code' => 'manager'],
            ['name' => 'Employee', 'code' => 'employee'],
        ];
        foreach ($roles as $role) {
            if(!Role::where('code', $role['code'])->exists()){
                Role::firstOrCreate(
                    ['code' => $role['code']],
                    ['name' => $role['name']]
                );
            }
        }
    }
}
