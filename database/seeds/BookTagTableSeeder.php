<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BookTagTableSeeder extends Seeder
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
        $tagId = App\Tag::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            DB::table('book_tag')->insert([
                'book_id' => $faker->randomElement($bookId),
                'tag_id' => $faker->randomElement($tagId),
            ]);
        }
    }
}
