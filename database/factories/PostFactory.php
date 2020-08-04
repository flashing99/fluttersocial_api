<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1,250),
        'body'    => $faker->paragraph($faker->numberBetween(1,4)),
        'status'  => $faker->randomElement(['draft', 'publish'])
    ];
});
