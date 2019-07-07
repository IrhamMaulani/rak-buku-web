<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Bookmark;
use Faker\Generator as Faker;

$factory->define(Bookmark::class, function (Faker $faker) {

    $bookId = App\Book::pluck('id')->toArray();
    $userId = App\User::pluck('id')->toArray();

    return [
        'status' =>  $faker->randomElement(['0', 'completed', 'on-hold', 'plan-to-read', 'dropped', 're-reading']),
        'is_owned' => $faker->numberBetween(0, 1),
        'book_id' => $faker->randomElement($bookId),
        'user_id' => $faker->randomElement($userId),
    ];
});
