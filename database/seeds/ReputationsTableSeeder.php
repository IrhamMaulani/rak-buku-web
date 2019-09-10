<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ReputationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        if (DB::table('reputations')->get()->count() == 0) {

            DB::table('reputations')->insert([
                [
                    'name' => 'wizard',
                    'image_path' => $faker->imageUrl($width = 640, $height = 480),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'crafter',
                    'image_path' => $faker->imageUrl($width = 640, $height = 480),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'fire keeper',
                    'image_path' => $faker->imageUrl($width = 640, $height = 480),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'book worm',
                    'image_path' => $faker->imageUrl($width = 640, $height = 480),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'neutral',
                    'image_path' => $faker->imageUrl($width = 640, $height = 480),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ]);
        } else {
            echo "Table Already Seeded ";
        }
    }
}
