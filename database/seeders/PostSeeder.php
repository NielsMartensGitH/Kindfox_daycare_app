<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\ClientMainUser;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->delete();
        $faker = Factory::create('nl_BE');

        for ($i = 0; $i < 20; $i++) {

            $randomClientCompany= ClientMainUser::all()->random();
            $message = $faker->paragraph();
            $company_id = $randomClientCompany->company_id;
            $is_private = $faker->numberBetween(0, 1);
            if ($is_private) {
                $client_id = $randomClientCompany->client_id;
            } else {
                $client_id = null;
            }

            Post::create([
                'message' => $message,
                'company_id' => $company_id,
                'is_private' => $is_private,
                'client_id' => $client_id
            ]);
        }
    }
}
