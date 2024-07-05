<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Blogpost;
use Faker\Generator as Faker;

$factory->define(Blogpost::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'author_id' => factory(App\User::class),
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
