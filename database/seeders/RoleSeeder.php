<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::create(['name' => 'admin']);
        $subadmin = Role::create(['name' => 'subadmin']);

        Permission::create(['name' => 'add product']);
        Permission::create(['name' => 'edit product']);
        Permission::create(['name' => 'delete product']);
        Permission::create(['name' => 'view product']);

        $admin->givePermissionTo(['add product', 'edit product', 'delete product', 'view product']);
        $subadmin->givePermissionTo(['add product', 'edit product', 'delete product','view product']);
    }
}
