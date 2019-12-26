<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\BookImage;
use Faker\Generator as Faker;

$factory->define(BookImage::class, function (Faker $faker) {

    $bookId = App\Book::pluck('id')->toArray();
    $userId = App\User::pluck('id')->toArray();

    return [
        'name' => null,
        'book_id' => $faker->randomElement($bookId),
        'user_id' => $faker->randomElement($userId),
        'is_cover' => $faker->numberBetween(0, 1)
    ];
});
