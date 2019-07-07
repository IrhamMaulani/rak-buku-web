<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Book;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    $publisherId = App\Publisher::pluck('id')->toArray();
    $title = $faker->realText(15);
    $volume = $faker->numberBetween(1, 100);
    $edition = $faker->numberBetween(1, 20);
    $slug = $title . ' ' . $volume . ' ' . $edition;
    return [
        'title' => $title,
        'volume' => $volume,
        'description' => $faker->realText(35),
        'edition' => $edition,
        'print_year' => $faker->date($format = 'Y', $max = 'now'),
        'origin_language' =>  $faker->country,
        'publisher_id'    => $faker->randomElement($publisherId),
        'slug' => str_slug($slug, '-'),
    ];
});
