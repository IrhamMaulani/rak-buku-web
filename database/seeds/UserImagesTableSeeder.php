<?php

use Illuminate\Database\Seeder;

class UserImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\UserImage::class, 50)->create();
    }
}
