<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\Models\Media;

class MediaSeeder extends Seeder
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

        for ($i = 0; $i <= 20; $i++) {
            Media::create([
                'media_path' => 'https://picsum.photos/600/500'
            ]);
        }
    }
}
