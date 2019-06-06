<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Fligno\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'is_admin' => $faker->boolean,
        'description' => $faker->paragraph,
        'gender' => $faker->randomElement(['Male', 'Female', 'Others']),
        'email' => $faker->unique()->safeEmail,
        'avatar' => $faker->imageUrl(400, 400),
        'email_verified_at' => now(),
        'api_tokens' => Str::random(60),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
