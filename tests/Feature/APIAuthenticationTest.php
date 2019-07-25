<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class APIAuthenticationTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        // seed roles and permissions
        $this->artisan('db:seed');
    }

    public function test_login_api()
    {
        $user = factory(User::class)->create();

        $this->post(route('api.login'), [
            'email' => $user->email,
            'password' => env('USER_DEFAULT_PASSWORD')
        ])
             ->assertSuccessful()
             ->assertSee('token');
    }

    public function test_gagal_login_api()
    {
        $this->post(route('api.login'), [
            'email' => $this->faker->name,
            'password' => $this->faker->password
        ])
             ->assertUnauthorized()
             ->assertDontSee('token');
    }

    public function test_akses_api_dengan_token()
    {
        $user = factory(User::class)->create();

        $this->get(route('api.index'), [
            'Authorization' => 'Bearer '.$user->api_token,
            'Accept' => 'application/json'
        ])
             ->assertOk()
             ->assertSee('You are authenticated.');
    }

    public function test_gagal_akses_api_tanpa_token()
    {
        $this->get(route('api.index'), [
            'Accept' => 'application/json'
        ])
             ->assertUnauthorized()
             ->assertSee('Unauthenticated.');
    }

    public function test_gagal_akses_route_dengan_permission_tanpa_izin()
    {
        $user = factory(User::class)->create()
                                    ->removeRole('admin');

        $this->get(route('users.index'), [
            'Authorization' => 'Bearer '.$user->api_token,
            'Accept' => 'application/json'
        ])
             ->assertForbidden();
    }
}
