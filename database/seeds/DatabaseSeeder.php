<?php

use Faker\Factory;
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
        // $this->call(UserSeeder::class);
        Factory(App\User::class, 10)->create();
        Factory(App\Category::class, 10)->create();
        Factory(App\Post::class, 10)->create();
    }
}
