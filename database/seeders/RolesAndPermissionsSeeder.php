<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        Permission::create(['name'=>'add_user']);
        Permission::create(['name'=>'view_user']);
        Permission::create(['name'=>'edit_user']);
        Permission::create(['name'=>'delete_user']);

        // Create roles
        Role::create(['name'=>'super-admin'])->givePermissionTo(Permission::all());
        Role::create(['name'=>'user'])->givePermissionTo(['view_user']);
    }
}
