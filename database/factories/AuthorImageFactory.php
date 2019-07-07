<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\AuthorImage;
use Faker\Generator as Faker;

$factory->define(AuthorImage::class, function (Faker $faker) {

    $userId = App\User::pluck('id')->toArray();
    $authorId = App\Author::pluck('id')->toArray();

    return [
        'name' => $faker->imageUrl($width = 640, $height = 480),
        'user_id' => $faker->randomElement($userId),
        'author_id' => $faker->randomElement($authorId)
    ];
});
