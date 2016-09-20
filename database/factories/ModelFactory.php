<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// TODO: Assign the rentals factory.

$factory->define(App\Groups::class, function (Faker\Generator $faker) {
    return [
        'selector'    => $faker->name,
        'sub_heading' => $faker->name, 
        'heading'     => $faker->name, 
        'description' => $faker->name
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
