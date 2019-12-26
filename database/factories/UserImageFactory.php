<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\UserImage;
use Faker\Generator as Faker;

$factory->define(UserImage::class, function (Faker $faker) {
    $userId = App\User::pluck('id')->toArray();
    return [
        'name' => null,
        'is_use' => $faker->numberBetween(0, 1),
        'user_id' => $faker->randomElement($userId),
    ];
});
