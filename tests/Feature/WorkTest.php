<?php

namespace Tests\Feature;

use App\Work;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkTest extends TestCase
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

    public function test_melihat_semua_work()
    {
        $users = factory(User::class, 2)->create();

        $user = $users->last()->assignRole([ 'user', 'ppic' ]);

        $this->assertTrue($user->can('view all works'));
        $this->setHeaderToken($user->api_token)
             ->get(route('works.index'))
             ->assertOk()
             ->assertSee('data');
    }

    public function test_melihat_detail_work()
    {
        $users = factory(User::class, 2)->create();

        $user = $users->last()->assignRole([ 'user', 'ppic' ]);

        $work = factory(work::class)->create([ 'user_id' => $user->id ]);

        $this->assertTrue($user->can('view work'));
        $this->setHeaderToken($user->api_token)
             ->get(route('works.show', [ 'work' => $work->id ]))
             ->assertOk()
             ->assertJsonStructure([
                 'data' => [ 'id' ]
             ]);
    }

    public function test_update_work_sendiri()
    {
        $users = factory(User::class, 2)->create();

        $user = $users->last()->assignRole([ 'user', 'ppic' ]);

        $work = factory(Work::class)->create([ 'user_id' => $user->id ]);

        $update = 'cancel';

        $this->setHeaderToken($user->api_token)
             ->put(route('works.update', [ 'work' => $work->id ]), [ 'status' => $update ])
             ->assertSuccessful()
             ->assertSee($update);
    }

    public function test_membuat_work()
    {
        $users = factory(User::class, 2)->create();

        $user = $users->last()->assignRole([ 'user', 'ppic' ]);

        $create = [
            'description' => $this->faker->sentence(10),
        ];

        $this->assertTrue($user->can('create work'));
        $this->setHeaderToken($user->api_token)
             ->post(route('works.store'), $create)
             ->assertStatus(201)
             ->assertSee($create['description']);
        $this->assertDatabaseHas('works', $create);
    }

    public function test_menghapus_work_sendiri()
    {
        $users = factory(User::class, 2)->create();

        $user = $users->last()->assignRole([ 'user', 'ppic' ]);

        $work = factory(Work::class)->create([ 'user_id' => $user->id ]);

        $this->setHeaderToken($user->api_token)
             ->delete(route('works.destroy', [ 'work' => $work->id ]))
             ->assertSuccessful();
        $this->assertDatabaseMissing('works', $work->toArray());
    }
}
