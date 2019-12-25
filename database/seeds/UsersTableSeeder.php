<?php

use App\Role;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('users')->get()->count() == 0) {
            DB::table('users')->insert([
                [
                    'name' => 'moderator',
                    'email' =>  'moderator@moderator.com',
                    'reputation_id' => 1,
                    'full_name' => 'moderator',
                    'is_ban' => 0,
                    'password' => bcrypt('moderator123456789'),
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
                [
                    'name' => 'user',
                    'email' =>  'user@user.com',
                    'reputation_id' => 1,
                    'full_name' => 'user',
                    'is_ban' => 0,
                    'password' => bcrypt('user123456789'),
                    'email_verified_at' => now(),
                    'remember_token' => Str::random(10),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            ]);
            $moderator = User::whereName('moderator')->first();
            $moderator->roles()
                ->sync([Role::whereName('moderator')->first()->id]);


            $user = User::whereName('user')->first();
            $user->roles()->sync(Role::whereName('member')->first()->id);
        }
    }
}
