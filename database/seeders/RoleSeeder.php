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
        $superAdminRole = Role::create(['name' => 'SuperAdmin']);
        $AdminRole = Role::create(['name' => 'Admin']);
        $userRole = Role::create(['name' => 'User']);


        // Define all permissions
        $permissions = [
            'Post Ad',
            'Manage Ad',
            'Manage Admin Dashbaord',
            'Edit Ad Status',
            'Edit App Setting',
            'Edit Coins Setting',

        ];

        // Create and assign permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign all permissions to the Admin role
        $superAdminRole->givePermissionTo($permissions);

        // Assign specific permissions to the User role
        $userRole->givePermissionTo([
            'Post Ad',
            'Manage Ad',
        ]);
        $AdminRole->givePermissionTo([
            'Post Ad',
            'Manage Ad',
            'Manage Admin Dashbaord',
            'Edit Ad Status',

        ]);
    }
}
