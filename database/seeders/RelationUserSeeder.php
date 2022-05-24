<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\MainUser;
use App\Models\RelationUser;
use Illuminate\Support\Facades\DB;

class RelationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('relation_users')->delete();
        $faker = Factory::create('nl_BE');
        for ($i = 0; $i < 20; $i++) {
            $main_user_id = MainUser::all()->random()->id;
            $related_user_id = MainUser::all()->except($main_user_id)->random()->id;
            $relationUserId = RelationUser::all()->pluck('related_user_id')->toArray();
            $mainUserId = RelationUser::all()->pluck('main_user_id')->toArray();
            if (
                !in_array($related_user_id, $relationUserId) &&
                !in_array($main_user_id, $relationUserId) &&
                !in_array($related_user_id, $mainUserId) &&
                !in_array($main_user_id, $mainUserId)
            ) {
                RelationUser::insertOrIgnore([
                    'main_user_id' => $main_user_id,
                    'related_user_id' => $related_user_id,
                    'created_at' =>  \Carbon\Carbon::now(), # new \Datetime()
                    'updated_at' => \Carbon\Carbon::now()  # new \Datetime()
                ]);
                RelationUser::insertOrIgnore([
                    'main_user_id' => $related_user_id,
                    'related_user_id' => $main_user_id,
                    'created_at' =>  \Carbon\Carbon::now(), # new \Datetime()
                    'updated_at' => \Carbon\Carbon::now()  # new \Datetime()
                ]);

            } else {
                continue;
            }
        }
    }
}
