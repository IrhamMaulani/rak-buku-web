<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    $name = $faker->name;

    $userId = App\User::pluck('id')->toArray();

    return [
        'name' => $name,
        'pen_name' => $faker->lastName . ' ' .  $faker->title(),
        'slug' => str_slug($name, '-'),
        'birth_place' => $faker->country, // secret
        'birth_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'residence_place' =>  $faker->country,
        'user_id'    => $faker->unique()->randomElement($userId),
    ];
});
