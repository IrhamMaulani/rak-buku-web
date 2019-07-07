<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\UserImage;
use Faker\Generator as Faker;

$factory->define(UserImage::class, function (Faker $faker) {
    $userId = App\User::pluck('id')->toArray();
    return [
        'name' => $faker->imageUrl($width = 640, $height = 480),
        'is_use' => $faker->numberBetween(0, 1),
        'user_id' => $faker->randomElement($userId),
    ];
});
