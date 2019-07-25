<?php

namespace App\Observers;

use App\Material;
use Faker\Factory as Faker;

class MaterialObserver
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Handle the material "created" event.
     *
     * @param  \App\Material  $material
     * @return void
     */
    public function created(Material $material)
    {
        //
    }

    /**
     * Handle the material "updated" event.
     *
     * @param  \App\Material  $material
     * @return void
     */
    public function updated(Material $material)
    {
        //
    }

    /**
     * Handle the material "deleted" event.
     *
     * @param  \App\Material  $material
     * @return void
     */
    public function deleted(Material $material)
    {
        //
    }

    /**
     * Handle the material "restored" event.
     *
     * @param  \App\Material  $material
     * @return void
     */
    public function restored(Material $material)
    {
        //
    }

    /**
     * Handle the material "force deleted" event.
     *
     * @param  \App\Material  $material
     * @return void
     */
    public function forceDeleted(Material $material)
    {
        //
    }

    /**
     * Handle the material "creating" event.
     *
     * @param  \App\Material  $material
     * @return void
     */
    public function creating(Material $material)
    {
        $material->batch = $this->faker->isbn10;
    }
}
