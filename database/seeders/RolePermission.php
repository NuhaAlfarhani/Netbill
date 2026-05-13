<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // permissions
        $permissions = [
            // dashboard
            'dashboard.view',

            // customers
            'customers.view',
            'customers.store',
            'customers.update',
            'customers.destroy',
            'customers.show',

            // bills
            'bills.view',
            'bills.create',
            'bills.generate',
            'bills.paid',
            'bills.delete',
            'bills.print',

            // packages
            'packages.view',
            'packages.create',
            'packages.edit',
            'packages.delete',
            'packages.print',

            // reports
            'reports.view',
            'reports.export',

            // logs
            'logs.view',

            // users
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',

            // roles
            'roles.view',
            'roles.edit',

            // settings
            'settings.view',
            'settings.edit',

            // mikrotik
            'mikrotik.view',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // admin role
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        
        $adminRole->syncPermissions($permissions);

        // cashier role
        $cashierRole = Role::firstOrCreate(['name' => 'Cashier']);

        $cashierRole->syncPermissions([
            'dashboard.view',

            'customers.view',
            'customers.store',
            'customers.update',
            'customers.destroy',
            'customers.show',

            'bills.view',
            'bills.create',
            'bills.generate',
            'bills.paid',
            'bills.delete',
            'bills.print',

            'packages.view',
            'packages.print',

            'reports.view',
            'reports.export',

            'logs.view',
        ]);
    }
}
