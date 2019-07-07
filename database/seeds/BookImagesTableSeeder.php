<?php

use Illuminate\Database\Seeder;

class BookImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\BookImage::class, 35)->create();
    }
}
