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
            'view all roles', 'view role', 'sync permissions', 'assign role',
            'view all permissions', 'view permission',
            'view all purchases', 'view purchase', 'update purchase', 'create purchase', 'delete purchase',
            'view all works', 'view work', 'update work', 'create work', 'delete work',
            'view all products', 'view product', 'update product', 'create product', 'delete product',
            'view all materials', 'view material', 'update material', 'create material', 'delete material',
        ];

        foreach($apiPermissions as $p) {
            Permission::create([ 'name' => $p, 'guard_name' => 'api' ]);
        }

        // create roles and assign created permissions
        Role::create([ 'name' => 'admin', 'guard_name' => 'api' ])
            ->givePermissionTo([
                'view all users', 'view user', 'create user', 'delete user',
                'view all roles', 'view role', 'sync permissions', 'assign role',
                'view all permissions', 'view permission',
            ]);

        Role::create([ 'name' => 'user', 'guard_name' => 'api' ])
            ->givePermissionTo([
                'view user', 'view role', 'view permission',
            ]);

        Role::create([ 'name' => 'marketing', 'guard_name' => 'api' ])
            ->givePermissionTo([
                'view all purchases', 'view purchase', 'create purchase',
                'view all products', 'view product',
            ]);

        Role::create([ 'name' => 'ppic', 'guard_name' => 'api' ])
            ->givePermissionTo([
                'view all purchases', 'view purchase', 'update purchase',
                'view all works', 'view work', 'create work',
                'view all products', 'view product', 'update product',
                'view all materials', 'view material', 'update material',
            ]);

        Role::create([ 'name' => 'produksi', 'guard_name' => 'api' ])
            ->givePermissionTo([
                'view all products', 'view product', 'create product',
            ]);

        Role::create([ 'name' => 'warehouse', 'guard_name' => 'api' ])
            ->givePermissionTo([
                'view all products', 'view product', 'create product',
                'view all materials', 'view material', 'create material',
            ]);
    }
}
