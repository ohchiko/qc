<?php

namespace App\Observers;

use App\Work;
use Faker\Factory as Faker;

class WorkObserver
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Handle the work "created" event.
     *
     * @param  \App\Work  $work
     * @return void
     */
    public function created(Work $work)
    {
        //
    }

    /**
     * Handle the work "updated" event.
     *
     * @param  \App\Work  $work
     * @return void
     */
    public function updated(Work $work)
    {
        //
    }

    /**
     * Handle the work "deleted" event.
     *
     * @param  \App\Work  $work
     * @return void
     */
    public function deleted(Work $work)
    {
        //
    }

    /**
     * Handle the work "restored" event.
     *
     * @param  \App\Work  $work
     * @return void
     */
    public function restored(Work $work)
    {
        //
    }

    /**
     * Handle the work "force deleted" event.
     *
     * @param  \App\Work  $work
     * @return void
     */
    public function forceDeleted(Work $work)
    {
        //
    }

    /**
     * Handle the work "creating" event.
     *
     * @param  \App\Work  $work
     * @return void
     */
    public function creating(Work $work)
    {
        $work->batch = $this->faker->isbn10;
        $work->status = 'process';
    }
}
