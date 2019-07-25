<?php

namespace Tests\Feature;

use Spatie\Permission\Models\Permission;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // seed roles and permissions
        $this->artisan('db:seed');
    }

    public function test_melihat_semua_izin()
    {
        $user = factory(User::class)->create()
                                    ->givePermissionTo('view all permissions');

        $this->get(route('permissions.index'), [
            'Authorization' => 'Bearer '.$user->api_token,
            'Accept'        => 'application/json'
        ])
             ->assertSuccessful();
    }

    public function test_melihat_izin()
    {
        $user = factory(User::class)->create()
                                    ->givePermissionTo('view permission');

        $this->get(route('permissions.show', [ 'permission' => Permission::first()->id ]), [
            'Authorization' => 'Bearer '.$user->api_token,
            'Accept'        => 'application/json'
        ])
             ->assertSuccessful();
    }
}
