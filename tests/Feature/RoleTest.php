<?php

namespace Tests\Feature;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // seed roles and permissions
        $this->artisan('db:seed');
    }

    public function test_melihat_semua_role()
    {
        $user = factory(User::class)->create()
                                    ->givePermissionTo('view all roles');

        $this->get(route('roles.index'), [
            'Authorization' => 'Bearer '.$user->api_token,
            'Accept'        => 'application/json'
        ])
             ->assertSuccessful();
    }

    public function test_melihat_role()
    {
        $user = factory(User::class)->create()
                                    ->givePermissionTo('view role');

        $role = Role::create([ 'name' => $this->faker->jobTitle ]);

        $this->get(route('roles.show', [ 'role' => $role->id ]), [
            'Authorization' => 'Bearer '.$user->api_token,
            'Accept'        => 'application/json'
        ])
             ->assertSuccessful()
             ->assertSee($role->name);
    }

    public function test_sinkronasi_permission_ke_role()
    {
        $permissions = factory(Permission::class, 3)->create();

        $user = factory(User::class)->create()
                                    ->givePermissionTo('sync permissions');

        $role = Role::create([ 'name' => $this->faker->jobTitle, 'guard_name' => 'api' ]);

        $this->withHeaders([
            'Authorization' => 'Bearer '.$user->api_token,
            'Accept'        => 'application/json'
        ])
             ->put(route('roles.permissions', [ 'role' => $role->id ]), [ 'permissions' => $permissions->pluck('id')->toArray() ])
             ->assertSuccessful();
    }
}
