<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /*
    public function run(): void
    {
        $permissions = [
            'dashboard.view',
            'users.manage',
            'admins.manage',
            'reports.view',
            'settings.manage',
            'roles.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::findByName('super_admin');
        $admin = Role::findByName('admin');

        $superAdmin->syncPermissions($permissions);

        $admin->syncPermissions([
            'dashboard.view',
            'users.manage',
            'reports.view',
        ]);
    }
    */

    public function run(): void
    {
        $permissions = [

            'dashboard.view',

            'users.view',
            'users.manage',

            'admins.view',
            'admins.manage',

            'reports.view',

            'settings.manage',

            'roles.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        $superAdmin = Role::findByName('super_admin');
        $admin      = Role::findByName('admin');

        // Full access
        $superAdmin->syncPermissions($permissions);

        // Limited access
        $admin->syncPermissions([
            'dashboard.view',

            'users.view',
            'users.manage',

            'admins.view',

            'reports.view',
        ]);
    }
}
