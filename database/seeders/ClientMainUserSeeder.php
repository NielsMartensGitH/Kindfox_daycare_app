<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\ClientMainUser;
use App\Models\RelationUser;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\MainUser;
use App\Models\Client;

class ClientMainUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('client_main_users')->delete();

        for ($i = 0; $i < 20; $i++) {
            $client_id = Client::all()->random()->id;
            $main_user_id = MainUser::all()->random()->id;
            $company_id = Company::all()->random()->id;

            $mainUserArray = ClientMainUser::all()->pluck('main_user_id')->toArray();
            $clientArray = ClientMainUser::all()->pluck('client_id')->toArray();
            if (!in_array($client_id, $clientArray)) {
                ClientMainUser::insertOrIgnore([
                    'client_id' => $client_id,
                    'main_user_id' => $main_user_id,
                    'company_id' =>
                    !in_array($main_user_id, $mainUserArray)
                    ? $company_id
                    : ClientMainUser::where('main_user_id', $main_user_id)->first()->company_id,
                    'created_at' =>  \Carbon\Carbon::now(), # new \Datetime()
                    'updated_at' => \Carbon\Carbon::now(),  # new \Datetime()
                ]);
            }
        }
        $clientMainUsers = ClientMainUser::all();
        foreach($clientMainUsers as $clientMainUser) {
            $main_user_id = $clientMainUser->main_user_id;
            $company_id = $clientMainUser::where('main_user_id', $main_user_id)->first()->company_id;
            $client_id = $clientMainUser->client_id;
            $related_user_ids = RelationUser::where('main_user_id', '=', $main_user_id)->get();
            foreach($related_user_ids as $related_user) {
                ClientMainUser::create([
                    'client_id' => $client_id,
                    'main_user_id' => $related_user->related_user_id,
                    'company_id' => $company_id
                ]);
            }
        }
    }
}
