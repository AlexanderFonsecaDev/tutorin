<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Location;
use Faker\Generator as Faker;

$factory->define(Location::class, function (Faker $faker) {
    return [
        'address' => $faker->address,
        'state'   => $faker->state,
        'city'    => $faker->city
    ];
});
