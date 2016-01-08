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

$factory->define(App\LaravelRestCms\ApiKey\ApiKey::class, function (Faker\Generator $faker) {
    return [
        'key' => bcrypt(str_random(10)),
        'level' => rand(1, 9),
    ];
});

$factory->define(App\LaravelRestCms\User\User::class, function (Faker\Generator $faker) {
    return [
        'id' => rand(999999999, 9999999999),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'username' => $faker->userName,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});