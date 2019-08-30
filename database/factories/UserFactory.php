<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm',
        'admin' => '1',
        'active' => '1',
        'remember_token' => Str::random(10),
    ];
});
