<?php

namespace App\Providers;

use App\User;
use App\Purchase;
use App\Work;
use App\Material;
use App\Product;
use Illuminate\Support\ServiceProvider;
use App\Observers\UserObserver;
use App\Observers\PurchaseObserver;
use App\Observers\WorkObserver;
use App\Observers\MaterialObserver;
use App\Observers\ProductObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
        Purchase::observe(PurchaseObserver::class);
        Work::observe(WorkObserver::class);
        Material::observe(MaterialObserver::class);
        Product::observe(ProductObserver::class);
    }
}
