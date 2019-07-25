<?php

namespace Tests\Feature;

use App\User;
use App\Product;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
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
            'Accept'        => 'application/json'
        ]);
    }

    public function test_melihat_semua_produk()
    {
        $user = factory(User::class)->create()
                                   ->syncRoles([ 'produksi' ]);

        $this->assertTrue($user->can('view all products'));

        $this->setHeaderToken($user->api_token)
             ->get(route('products.index'))
             ->assertSuccessful()
             ->assertSee('data');
    }

    public function test_melihat_detail_produk()
    {
        $user = factory(User::class)->create()
                                   ->syncRoles([ 'produksi' ]);

        $product = factory(Product::class)->create([ 'user_id' => $user->id ]);

        $this->assertTrue($user->can('view product'));

        $this->setHeaderToken($user->api_token)
             ->get(route('products.show', [ 'product' => $product->id ]))
             ->assertSuccessful()
             ->assertSee($product->name)
             ->assertSee('data');
    }

    public function test_membuat_produk()
    {
        $user = factory(User::class)->create()
                                    ->syncRoles([ 'produksi' ]);

        $materials = factory(\App\Material::class, 3)->create([ 'user_id' => $user->id ])
                                                     ->pluck('id')
                                                     ->toArray();

        $product = \Arr::add(factory(Product::class)->make()->toArray(), 'materials', $materials);

        $this->assertTrue($user->can('create product'));

        $this->setHeaderToken($user->api_token)
             ->post(route('products.store'), $product)
             ->assertStatus(201)
             ->assertSee('data');

        $this->assertDatabaseHas('product_material', [ 'material_id' => $materials[0] ]);
        $this->assertDatabaseHas('products', [ 'name' => $product['name'] ]);
    }

    public function test_update_produk()
    {
        $user = factory(User::class)->create()
                                    ->syncRoles([ 'produksi' ]);

        $product = factory(Product::class)->create([ 'user_id' => $user->id ]);

        $update = $this->faker->colorName;

        $this->setHeaderToken($user->api_token)
             ->put(route('products.update', [ 'product' => $product->id ]), [ 'name' => $update ])
             ->assertSuccessful()
             ->assertSee($update)
             ->assertSee('data');

        $this->assertDatabaseHas('products', [ 'name' => $update ]);
    }

    public function test_menghapus_produk()
    {
        $user = factory(User::class)->create()
                                    ->syncRoles([ 'produksi' ]);

        $product = factory(Product::class)->create([ 'user_id' => $user->id ]);

        $this->setHeaderToken($user->api_token)
             ->delete(route('products.destroy', [ 'product' => $product->id ]))
             ->assertSuccessful();

        $this->assertDatabaseMissing('products', [ 'id' => $product->id ]);
    }
}
