<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Event;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('events')->delete();
        $faker = Factory::create('nl_BE');
        for ($i = 0; $i < 10; $i++) {
            $name = $faker->word();
            $company_id = Company::all()->random()->id;

            Event::create([
                'name' => $name,
                'company_id' => $company_id
            ]);
        }
    }
}
