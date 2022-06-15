<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Company;
use App\Models\Client;
use App\Models\ClientMainUser;
use App\Models\Diary;
use Illuminate\Support\Facades\DB;

class DiarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('diaries')->delete();
        $faker = Factory::create('nl_BE');


        for ($i = 0; $i < 20; $i++) {
            $food_message = $faker->paragraph();
            $food_smile = $faker->numberBetween(0, 1);
            $sleep_message = $faker->paragraph();
            $poop_icons = $faker->numberBetween(0, 5);
            $mood = 'good';
            $activity_message = $faker->paragraph();
            $involvement_message = $faker->paragraph();
            $extra_message = $faker->paragraph();
            $randomClientCompany= ClientMainUser::all()->random();
            $company_id = $randomClientCompany->company_id;
            $client_id = $randomClientCompany->client_id;

            Diary::create([
                'food_message' => $food_message,
                'food_smile' => $food_smile,
                'sleep_message' => $sleep_message,
                'poop_icons' => $poop_icons,
                'mood' => $mood,
                'activity_message' => $activity_message,
                'involvement_message' => $involvement_message,
                'extra_message' => $extra_message,
                'company_id' => $company_id,
                'client_id' => $client_id
            ]);

        }
    }

}