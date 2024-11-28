<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'SuperAdmin']);
        Role::create(['name' => 'Buyer']);
        Role::create(['name' => 'Seller']);

        // Define all permissions
        $permissions = [
            'Post Ad',
            'Manage Admin Dashbaord',
            'Manage Ad',

        ];

        // Create and assign permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign all permissions to the Admin role
        $adminRole->givePermissionTo($permissions);
    }
}
