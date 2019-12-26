<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ReputationsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(PublishersTableSeeder::class);
        $this->call(AuthorsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(BooksTableSeeder::class);
        // $this->call(UserImagesTableSeeder::class);
        // $this->call(BookImagesTableSeeder::class);
        // $this->call(AuthorImagesTableSeeder::class);
        // $this->call(ScoresTableSeeder::class);

        $this->call(AuthorBookTableSeeder::class);
        $this->call(BookTagTableSeeder::class);
        // $this->call(RoleUserTablerSeeder::class);

        // factory(App\User::class, 35)->create();

        // factory(App\Score::class, 100)->create();

        factory(App\Review::class, 35)->create();

        // factory(App\ReviewResponse::class, 35)->create();

        $this->call(SocialMediasTableSeeder::class);
    }
}
