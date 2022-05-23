<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory;
use App\Models\MainUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
            $firstName = $faker->firstName('male'|'female');
            $lastName = $faker->lastName();
            $email = Str::lower($firstName) . Str::lower($lastName) . '@' . $faker->freeEmailDomain();
            $password = Hash::make($faker->password(2, 6));
            $street = $faker->streetAddress();
            $country = $faker->state();
            $postal_code = $faker->postcode();
            $city = $faker->city();
            $phone_number = $faker->phoneNumber();

            MainUser::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'email' => $email,
                'password' => $password,
                'street_number' => $street,
                'country' => $country,
                'postal_code' => $postal_code,
                'city' => $city,
                'phone_number' => $phone_number
            ]);

        }
    }
}
