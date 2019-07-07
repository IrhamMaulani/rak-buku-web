<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Score;
use Faker\Generator as Faker;

$factory->define(Score::class, function (Faker $faker) {

    $bookId = App\Book::pluck('id')->toArray();
    $userId = App\User::pluck('id')->toArray();

    return [
        'score' => $faker->company,
        'is_recomend' => $faker->numberBetween(0, 1),
        'is_favorite' => $faker->numberBetween(0, 1),
        'book_id' => $faker->randomElement($bookId),
        'user_id' => $faker->randomElement($userId),
    ];
});
