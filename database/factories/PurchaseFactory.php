<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Purchase;
use Faker\Generator as Faker;

$factory->define(Purchase::class, function (Faker $faker) {
    return [
        'cust_name' => $faker->name,
        'description' => $faker->sentence(10),
        'est_delivery' => $faker->date,
    ];
});
