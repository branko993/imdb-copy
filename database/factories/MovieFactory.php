<?php

use App\Genre;
use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Movie::class, function (Faker $faker) {
    $genreId = Genre::all()->pluck('id')->toArray();
    $user_id = User::all()->pluck('id')->toArray();

    return [
        'title' => $faker->words(2, true),
        'description' => $faker->paragraph(10, true),
        'image_url' => $faker->imageUrl(640, 480),
        'genre_id' => $faker->randomElement($genreId),
        'user_id' => $faker->randomElement($user_id),
    ];
});
