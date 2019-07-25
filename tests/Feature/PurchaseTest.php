<?php

namespace Tests\Feature;

use App\Purchase;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    protected function setHeaderToken($token = null)
    {
        return $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
            'Accept' => 'application/json'
        ]);
    }

    public function test_melihat_semua_purchase()
    {
        $users = factory(User::class, 2)->create();

        $user = $users->last()->assignRole([ 'user', 'marketing' ]);

        $this->assertTrue($user->can('view all purchases'));
        $this->setHeaderToken($user->api_token)
             ->get(route('purchases.index'))
             ->assertOk()
             ->assertSee('data');
    }

    public function test_melihat_detail_purchase()
    {
        $users = factory(User::class, 2)->create();

        $user = $users->last()->assignRole([ 'user', 'marketing' ]);

        $purchase = factory(Purchase::class)->create([ 'user_id' => $user->id ]);

        $this->assertTrue($user->can('view purchase'));
        $this->setHeaderToken($user->api_token)
             ->get(route('purchases.show', [ 'purchase' => $purchase->id ]))
             ->assertOk()
             ->assertJsonStructure([
                 'data' => [ 'id' ]
             ]);
    }

    public function test_update_purchase_sendiri()
    {
        $users = factory(User::class, 2)->create();

        $user = $users->last()->assignRole([ 'user', 'marketing' ]);

        $purchase = factory(Purchase::class)->create([ 'user_id' => $user->id ]);

        $update = $this->faker->name;

        $this->setHeaderToken($user->api_token)
             ->put(route('purchases.update', [ 'purchase' => $purchase->id ]), [ 'cust_name' => $update ])
             ->assertSuccessful()
             ->assertSee($update);
    }

    public function test_membuat_purchase()
    {
        $users = factory(User::class, 2)->create();

        $user = $users->last()->assignRole([ 'user', 'marketing' ]);

        $create = [
            'cust_name' => $this->faker->name,
            'description' => $this->faker->sentence(10),
            'est_delivery' => $this->faker->dateTime
        ];

        $this->assertTrue($user->can('create purchase'));
        $this->setHeaderToken($user->api_token)
             ->post(route('purchases.store'), $create)
             ->assertStatus(201)
             ->assertSee($create['cust_name']);
        $this->assertDatabaseHas('purchases', $create);
    }

    public function test_menghapus_purchase_sendiri()
    {
        $users = factory(User::class, 2)->create();

        $user = $users->last()->assignRole([ 'user', 'marketing' ]);

        $purchase = factory(Purchase::class)->create([ 'user_id' => $user->id ]);

        $this->setHeaderToken($user->api_token)
             ->delete(route('purchases.destroy', [ 'purchase' => $purchase->id ]))
             ->assertSuccessful();
        $this->assertDatabaseMissing('purchases', $purchase->toArray());
    }
}
