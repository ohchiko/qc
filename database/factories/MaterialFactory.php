<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Material;
use Faker\Generator as Faker;

$factory->define(Material::class, function (Faker $faker) {
    return [
        'name' => $faker->colorName,
    ];
});
