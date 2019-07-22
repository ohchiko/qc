<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $apiPermissions = [
            'view all users', 'view user', 'update user', 'create user', 'delete user',
            'view all roles', 'view role', 'sync permissions',
            'view all permissions', 'view permission',
        ];

        foreach($apiPermissions as $p) {
            Permission::create([ 'name' => $p, 'guard_name' => 'api' ]);
        }

        // create roles and assign created permissions
        Role::create([ 'name' => 'admin', 'guard_name' => 'api' ])
            ->givePermissionTo([
                'view all users', 'view user', 'create user', 'delete user',
                'view all roles', 'view role', 'sync permissions',
                'view all permissions', 'view permission',
            ]);

        Role::create([ 'name' => 'user', 'guard_name' => 'api' ])
            ->givePermissionTo([
                'view user', 'view role', 'view permission'
            ]);
    }
}
