<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AuthorBookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker::create();

        $bookId = App\Book::pluck('id')->toArray();
        $authorId = App\Author::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            DB::table('author_book')->insert([
                'book_id' => $faker->randomElement($bookId),
                'author_id' => $faker->randomElement($authorId),
            ]);
        }
    }
}
