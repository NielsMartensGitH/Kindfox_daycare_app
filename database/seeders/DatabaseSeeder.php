<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        $this->call([
            CompanySeeder::class,
            ClientSeeder::class,
            MainUserSeeder::class,
            EventSeeder::class,
            RelationUserSeeder::class,
            ClientMainUserSeeder::class,
            DiarySeeder::class,
            PostSeeder::class,
            MediaSeeder::class
        ]);
    }
}
