<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create('nl_BE');

          for ($i = 0; $i <= 10; $i++) {
            $name = $faker->company();
            $vat_number = $faker->vat();
            $email = $faker->email();
            $password = Hash::make($faker->password(2, 6));
            $street = $faker->streetAddress();
            $country = $faker->state();
            $postal_code = $faker->postcode();
            $city = $faker->city();
            $phone_number = $faker->phoneNumber();

            Company::create([
                'name' => $name,
                'vat_number' => $vat_number,
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
