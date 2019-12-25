<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    $bookId = App\Book::pluck('id')->toArray();
    $userId = App\User::pluck('id')->toArray();
    $title = $faker->realText(15);
    $slug = $title . ' ' . ' ' . $faker->randomElement($bookId) . ' ' . $faker->randomElement($userId);
    return [
        'title' => $title,
        'content' => $faker->realText(45),
        'user_id' => $faker->randomElement($userId),
        'book_id' => $faker->randomElement($bookId),
        'slug' => str_slug($slug, '-'),
        'likes' => 0,
        'dislikes' => 0
    ];
});
