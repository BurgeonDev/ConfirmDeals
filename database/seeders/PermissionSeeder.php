<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run()
    {
        // Define permissions
        $permissions = [
            'Post Ad',
            'Manage Ad',
            'Manage Admin Dashbaord',
            'Edit Ad Status',
            'Edit App Setting',
            'Edit Coins Setting',
            'Manage User and Roles',

        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
