<?php

namespace Tests\Feature;

use App\User;
use App\Material;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MaterialTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');
    }

    public function setHeaderToken($token = null)
    {
        return $this->withHeaders([
            'Authorization' => 'Bearer '.$token,
            'Accept'        => 'application/json'
        ]);
    }

    public function test_melihat_semua_material()
    {
        $user = factory(User::class)->create()
                                    ->syncRoles([ 'warehouse' ]);

        $this->assertTrue($user->can('view all materials'));

        $this->setHeaderToken($user->api_token)
             ->get(route('materials.index'))
             ->assertOk()
             ->assertSee('data');
    }

    public function test_melihat_detail_material()
    {
        $user = factory(User::class)->create()
                                    ->syncRoles([ 'warehouse' ]);

        $material = factory(Material::class)->create([ 'user_id' => $user->id ]);

        $this->assertTrue($user->can('view material'));

        $this->setHeaderToken($user->api_token)
             ->get(route('materials.show', [ 'material' => $material->id ]))
             ->assertOk()
             ->assertSee('data')
             ->assertSee($material->name);
    }

    public function test_membuat_material()
    {
        $user = factory(User::class)->create()
                                    ->syncRoles([ 'warehouse' ]);

        $material = factory(Material::class)->make();

        $this->assertTrue($user->can('create material'));

        $this->setHeaderToken($user->api_token)
             ->post(route('materials.store'), $material->toArray())
             ->assertStatus(201)
             ->assertSee('data')
             ->assertSee($material->name);

        $this->assertDatabaseHas('materials', [ 'name' => $material->name ]);
    }

    public function test_update_material()
    {
        $user = factory(User::class)->create()
                                    ->syncRoles([ 'warehouse' ]);

        $material = factory(Material::class)->create([ 'user_id' => $user->id ]);

        $update = $this->faker->colorName;

        $this->setHeaderToken($user->api_token)
             ->put(route('materials.update', [ 'material' => $material->id ]), [ 'name' => $update ])
             ->assertSuccessful()
             ->assertSee('data')
             ->assertSee($update);

        $this->assertDatabaseHas('materials', [ 'name' => $update ]);
    }

    public function test_menghapus_material()
    {
        $user = factory(User::class)->create()
                                    ->syncRoles([ 'warehouse' ]);

        $material = factory(Material::class)->create([ 'user_id' => $user->id ]);

        $this->setHeaderToken($user->api_token)
             ->delete(route('materials.destroy', [ 'material' => $material->id ]))
             ->assertSuccessful();

        $this->assertDatabaseMissing('materials', [ 'id' => $material->id ]);
    }
}
