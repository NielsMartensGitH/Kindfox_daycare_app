<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\MainUser;
use App\Models\Company;
use Illuminate\Support\Arr;


class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->delete();
        $faker = Factory::create('nl_BE');
        $main_user_ids = MainUser::all()->pluck('id')->toArray();
        array_push($main_user_ids, null);
        $company_ids = Company::all()->pluck('id')->toArray();

        for ($i = 0; $i < 30; $i++) {
            $message = $faker->paragraph();
            $main_user_id = Arr::random($main_user_ids);
            $company_id = $main_user_id ? null : Arr::random($company_ids);

            Comment::create([
                'message' => $message,
                'main_user_id' => $main_user_id,
                'company_id' => $company_id
            ]);
        }
    }
}
