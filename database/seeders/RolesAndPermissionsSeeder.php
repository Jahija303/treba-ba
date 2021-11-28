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

        Permission::create(['name'=>'add_city']);
        Permission::create(['name'=>'view_city']);
        Permission::create(['name'=>'edit_city']);
        Permission::create(['name'=>'delete_city']);

        Permission::create(['name'=>'add_district']);
        Permission::create(['name'=>'view_district']);
        Permission::create(['name'=>'edit_district']);
        Permission::create(['name'=>'delete_district']);

        Permission::create(['name'=>'add_category']);
        Permission::create(['name'=>'view_category']);
        Permission::create(['name'=>'edit_category']);
        Permission::create(['name'=>'delete_category']);

        Permission::create(['name'=>'add_issue']);
        Permission::create(['name'=>'view_issue']);
        Permission::create(['name'=>'edit_issue']);
        Permission::create(['name'=>'delete_issue']);

        Permission::create(['name'=>'manage_roles']);
        Permission::create(['name'=>'manage_permissions']);
        Permission::create(['name'=>'access_dashboard']);

        // Create roles
        Role::create(['name'=>'super-admin'])->givePermissionTo(Permission::all());
        Role::create(['name'=>'local-admin'])->givePermissionTo([
            'view_user',
            'add_city', 'view_city', 'edit_city', 'delete_city',
            'add_district', 'view_district', 'edit_district', 'delete_district',
            'add_category', 'view_category', 'edit_category', 'delete_category',
            'view_issue', 'edit_issue']);
        Role::create(['name'=>'user'])->givePermissionTo(['view_user','view_city','view_district','view_issue', 'view_category']);
    }
}
