<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Company;
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
        $faker = Factory::create('nl_BE');

          for ($i = 0; $i < 10; $i++) {
            $name = $faker->company();
            $vat_number = $faker->vat();
            // $email = Str::lower($name) . '@' . $faker->freeEmailDomain();
            // $password = Hash::make($faker->password(2, 6));
            $street = $faker->streetAddress();
            $country = $faker->state();
            $postal_code = $faker->postcode();
            $city = $faker->city();
            $phone_number = $faker->phoneNumber();

            Company::create([
                'name' => $name,
                'vat_number' => $vat_number,
                'street_number' => $street,
                'country' => $country,
                'postal_code' => $postal_code,
                'city' => $city,
                'phone_number' => $phone_number
            ]);
            }
    }
}
