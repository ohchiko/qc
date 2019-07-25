<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Work;
use Faker\Generator as Faker;

$factory->define(Work::class, function (Faker $faker) {
    return [
        'description'   => $faker->sentence(10),
    ];
});
