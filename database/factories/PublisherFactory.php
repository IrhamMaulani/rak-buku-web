<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Publisher;
use Faker\Generator as Faker;

$factory->define(Publisher::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'address' => $faker->address,
        'city' => $faker->city,
        'country' => $faker->country,

    ];
});
