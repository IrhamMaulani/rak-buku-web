<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class SocialMediasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('social_medias')->get()->count() == 0) {

            DB::table('social_medias')->insert([
                [
                    'name' => 'twitter',
                    'image_path' =>'social_medias/twitter.png',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'facebook',
                    'image_path' =>'social_medias/facebook.png',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'instagram',
                    'image_path' => 'social_medias/instagram.png',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]

            ]);
        } else {
            echo "Table Already Seeded ";
        }
    }
}
