<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;
use App\Models\MainUser;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


class MainUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('main_users')->delete();
        $faker = Factory::create('nl_BE');

        for ($i = 0; $i < 10; $i++) {

            $response = Http::get('https://randomuser.me/api/');
            // CREATE RANDOM MAINUSER
            $street = $faker->streetAddress();
            $country = $faker->state();
            $postal_code = $faker->postcode();
            $city = $faker->city();
            $phone_number = $faker->phoneNumber();
            $firstName = $response->json()['results'][0]['name']['first'];
            $lastName = $response->json()['results'][0]['name']['last'];
            $user_pic = $response->json()['results'][0]['picture']["large"];

            $main_user = MainUser::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'street_number' => $street,
                'country' => $country,
                'postal_code' => $postal_code,
                'city' => $city,
                'phone_number' => $phone_number
            ]);

            $main_user->addMediaFromUrl($user_pic)->toMediaCollection();
            $name = $firstName;
            $email = $faker->safeEmail();
            $password = $password = Hash::make('abc123456789');

            User::create([
                "name" => $name,
                "email" => $email,
                "email_verified_at" => null,
                "password" => $password,
                "company_id" => null,
                "main_user_id" => $main_user->id,
                "role_id" => 1,
                "remember_token" => null,
                "active_status" => 0,
                "avatar" => "avatar.png",
                "dark_mode" => 0,
                "messenger_color" => "#2180f3"
            ]);

        }
    }
}
