<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ReviewResponse;
use Faker\Generator as Faker;

$factory->define(ReviewResponse::class, function (Faker $faker) {
    $reviewId = App\Review::pluck('id')->toArray();
    $userId = App\User::pluck('id')->toArray();

    return [
        'is_helpful' => $faker->randomElement([1, 0]),
        'user_id' => $faker->randomElement($userId),
        'review_id' => $faker->randomElement($reviewId),
        'is_like' =>  $faker->randomElement([1, 0])
    ];
});
