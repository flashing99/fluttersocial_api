<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id'           => $faker->numberBetween(1,250),
        'body'              => $faker->sentence(),

        /*
         * following two line is to make fake comment to post not to comment
         * if want to make fake comment to comment should be use in commentable_type => App\Comment::class
         *
         * */
        'commentable_id'    => $faker->numberBetween(1,2500),
        //'commentable_type'  => App\Post::class
        'commentable_type'  => App\Comment::class
    ];
});
