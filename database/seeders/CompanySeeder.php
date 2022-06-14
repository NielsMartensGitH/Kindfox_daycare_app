<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('companies')->delete();
        DB::table('users')->delete();
        DB::table('media')->delete();
        $faker = Factory::create('nl_BE');

          for ($i = 0; $i < 10; $i++) {
            $name = $faker->company();
            $vat_number = $faker->vat();
            $street = $faker->streetAddress();
            $country = $faker->state();
            $postal_code = $faker->postcode();
            $city = $faker->city();
            $phone_number = $faker->phoneNumber();

            $company = Company::create([
                'name' => $name,
                'vat_number' => $vat_number,
                'street_number' => $street,
                'country' => $country,
                'postal_code' => $postal_code,
                'city' => $city,
                'phone_number' => $phone_number
            ]);
            $name = $name;
            $email = $faker->safeEmail();
            $password = $password = Hash::make('abc123456789');

            $company->addMediaFromUrl('https://nielsmartens-cv.netlify.app/daycarelogo.jpg')->toMediaCollection();;

            User::create([
                "name" => $name,
                "email" => $email,
                "email_verified_at" => null,
                "password" => $password,
                "company_id" => $company->id,
                "main_user_id" => null,
                "role_id" => 2,
                "remember_token" => null,
                "active_status" => 0,
                "avatar" => "avatar.png",
                "dark_mode" => 0,
                "messenger_color" => "#2180f3"
            ]);
            }
    }
}
