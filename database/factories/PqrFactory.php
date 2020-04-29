<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Pqr;
use Faker\Generator as Faker;

$factory->define(Pqr::class, function (Faker $faker) {

    $title = $faker->sentence(4);

    return [
        'user_id' 		=> rand(1,30),
        'title' 		=> $title,
        'description' 	=> $faker->text(500),
        'status'        => $faker->randomElement(['REQUEST', 'NAGGING','CLAIM'])
    ];
});
