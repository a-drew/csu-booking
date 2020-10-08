<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        // Permissions map, separated by relevant model object
        $permissions = [
            'users',
            'users.select',
            'users.select.same-role',
            'users.create',
            'users.update',
            'users.delete',

            'permissions',
            'permissions.assign', // to roles
            'permissions.create',
            'permissions.update',
            'permissions.delete',

            'roles',
            'roles.assign', // to users
            'roles.create',
            'roles.update',
            'roles.delete',

            'bookings',
            'bookings.request', // create & update
            'bookings.approve', // view & respond
            'bookings.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        Role::create(['name' => 'super-admin'])->givePermissionTo([
            'users', 'roles', 'permissions', 'bookings'
        ]);
    }
}
