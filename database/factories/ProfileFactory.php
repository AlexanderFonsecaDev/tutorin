<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'dni'         => $faker->unique()->word,
        'description' => $faker->text,
        'valoration'  => $faker->numberBetween(0,5),
    ];
});
