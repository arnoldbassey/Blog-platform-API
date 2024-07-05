<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph,
        'blogposts_id' => factory(App\Blogpost::class),
        'author_id' => factory(App\User::class),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
