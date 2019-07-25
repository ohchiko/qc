<?php

namespace App\Observers;

use App\Purchase;
use Faker\Factory as Faker;

class PurchaseObserver
{
    protected $faker;

    public function __construct()
    {
        $this->faker = Faker::create();
    }

    /**
     * Handle the purchase "created" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function created(Purchase $purchase)
    {
        //
    }

    /**
     * Handle the purchase "updated" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function updated(Purchase $purchase)
    {
        //
    }

    /**
     * Handle the purchase "deleted" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function deleted(Purchase $purchase)
    {
        //
    }

    /**
     * Handle the purchase "restored" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function restored(Purchase $purchase)
    {
        //
    }

    /**
     * Handle the purchase "force deleted" event.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function forceDeleted(Purchase $purchase)
    {
        //
    }

    /**
     * Handle the purchase "creating" even.
     *
     * @param  \App\Purchase  $purchase
     * @return void
     */
    public function creating(Purchase $purchase)
    {
        $purchase->batch = $this->faker->isbn10;
        $purchase->status = 'process';
    }
}
