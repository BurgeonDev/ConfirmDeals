<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $adminRole = Role::create(['name' => 'SuperAdmin']);
        Role::create(['name' => 'Buyer']);
        Role::create(['name' => 'Seller']);
    }
}
