<?php

namespace Tests\Feature;

use Arr;
use Spatie\Permission\Models\Permission;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $permissions;

    protected function setUp(): void
    {
        parent::setUp();

        // seed roles and permissions
        $this->artisan('db:seed');

        $this->permissions = [
            'viewAll'       => 'view all users',
            'view'          => 'view user',
            'create'        => 'create user',
            'update'        => 'update user',
            'delete'        => 'delete user',
        ];
    }

    protected function setHeaderToken($token = null)
    {
        return $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
            'Accept' => 'application/json'
        ]);
    }

    protected function generateUser()
    {
        $user = [
            'name'      => $this->faker->name,
            'email'     => $this->faker->email,
            'password'  => $this->faker->password
        ];

        $user['password_confirmation'] = $user['password'];

        return $user;
    }

    public function test_melihat_semua_user()
    {
        $user = factory(User::class)->create()
                                    ->givePermissionTo($this->permissions['viewAll']);

        $this->setHeaderToken($user->api_token)
             ->get(route('users.index'))
             ->assertSuccessful()
             ->assertSee('data');
    }

    public function test_gagal_melihat_semua_user_tanpa_izin()
    {
        $user = factory(User::class)->create()
                                    ->removeRole('admin');

        $this->setHeaderToken($user->api_token)
            ->get(route('users.index'))
            ->assertForbidden()
            ->assertDontSee('data');
    }

    public function test_melihat_user()
    {
        $users = factory(User::class, 2)->create();

        $users->first()->givePermissionTo($this->permissions['view']);

        $this->setHeaderToken($users->first()->api_token)
             ->get(route('users.show', [ 'user' => $users->last()->id ]))
             ->assertSuccessful()
             ->assertSee($users->last()->name);
    }

    public function test_membuat_user()
    {
        $user = factory(User::class)->create()
                                    ->givePermissionTo($this->permissions['create']);

        $newUser = $this->generateUser();

        $this->setHeaderToken($user->api_token)
             ->post(route('users.store'), $newUser)
             ->assertStatus(201);

        $this->assertDatabaseHas('users', [ 'name' => $newUser['name'] ]);
    }

    public function test_gagal_membuat_user_data_tidak_valid()
    {
        $user = factory(User::class)->create()
                                    ->givePermissionTo($this->permissions['create']);

        $newUser = Arr::except($this->generateUser(), [ 'password_confirmation' ]);

        $this->setHeaderToken($user->api_token)
             ->post(route('users.store'), $newUser)
             ->assertStatus(422)
             ->assertSee('invalid');
    }

    public function test_update_user()
    {
        $users = factory(User::class, 2)->create();

        $users->first()->givePermissionTo($this->permissions['update']);

        $newName = $this->faker->name;

        $this->setHeaderToken($users->first()->api_token)
             ->put(route('users.update', [ 'user' => $users->last()->id ]), [ 'name' => $newName ])
             ->assertSuccessful();

        $this->assertDatabaseHas('users', [ 'name' => $newName ])
             ->assertDatabaseMissing('users', [ 'name' => $users->last()->name ]);
    }

    public function test_self_update_tanpa_izin()
    {
        $user = factory(User::class)->create();

        $this->setHeaderToken($user->api_token)
             ->put(route('users.update', [ 'user' => $user->id ]), [ 'name' => $this->faker->name ])
             ->assertSuccessful()
             ->assertDontSee($user->name)
             ->assertsee($user->email);
    }

    public function test_hapus_user()
    {
        $users = factory(User::class, 2)->create();

        $users->first()->givePermissionTo($this->permissions['delete']);

        $this->setHeaderToken($users->first()->api_token)
             ->delete(route('users.destroy', [ 'user' => $users->last()->id ]))
             ->assertSuccessful();

        $this->assertSoftDeleted('users', [ 'id' => $users->last()->id ]);
    }

    public function test_memberikan_role_ke_user()
    {
        $users = factory(User::class, 2)->create();

        $this->assertTrue($users->first()->can('assign role'));
        $this->setHeaderToken($users->first()->api_token)
             ->put(route('users.role', [ 'user' => $users->last()->id, 'role' => 'ppic' ]))
             ->assertSuccessful();
        $this->assertTrue($users->last()->hasRole('ppic'));
    }
}
