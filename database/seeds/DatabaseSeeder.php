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
        // Seed tables in order according to foreign key relationship
        $this->call(UsersTableSeeder::class);
        $this->call(BackgroundsTableSeeder::class);
        $this->call(PostersTableSeeder::class);
    }
}
