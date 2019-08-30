<?php

use Faker\Generator as Faker;

$factory->define(App\Categories::class, function (Faker $faker) {
    return [
        'id' => 1,
        'name' => $faker->name
    ];
});
