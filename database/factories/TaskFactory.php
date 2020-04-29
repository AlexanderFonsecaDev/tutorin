<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {

    $title = $faker->sentence(4);

    return [
        'user_id' 		=> rand(1,30),
        'category_id' 	=> rand(1,20),
        'name' 			=> $title,
        'excerpt' 		=> $faker->text(200),
        'body' 			=> $faker->text(500),
        'price' 		=> $faker->numberBetween(10000,1000000),
        'delivery'      => $faker->dateTimeBetween('now', '+30 years'),
        'status'        => $faker->randomElement(['PUBLISHED', 'CANCELLED'])
    ];
});
