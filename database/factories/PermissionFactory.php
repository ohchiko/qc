<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Spatie\Permission\Models\Permission;
use Faker\Generator as Faker;

$factory->define(Permission::class, function (Faker $faker) {
    return [
        'name' => $faker->bs,
        'guard_name' => 'api'
    ];
});
