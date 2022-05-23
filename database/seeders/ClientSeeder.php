<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->delete();
        $faker = Factory::create('nl_BE');

        for ($i = 0; $i < 10; $i++) {
            $firstName = $faker->firstName('male'|'female');
            $lastName = $faker->lastName();
            $age = $faker->numberBetween(0, 12);
            $checked_in = $faker->numberBetween(0, 1);

            Client::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'age' => $age,
                'checked_in' => $checked_in
            ]);
        }
    }
}
