<?php

use Illuminate\Database\Seeder;

class AuthorImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\AuthorImage::class, 25)->create();
    }
}
