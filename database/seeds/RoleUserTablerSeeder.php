<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class RoleUserTablerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $roleId = App\Role::pluck('id')->toArray();
        $userId = App\User::pluck('id')->toArray();

        for ($i = 0; $i < 50; $i++) {
            DB::table('role_user')->insert([
                'role_id' => $faker->randomElement($roleId),
                'user_id' => $faker->randomElement($userId),
            ]);
        }
    }
}
