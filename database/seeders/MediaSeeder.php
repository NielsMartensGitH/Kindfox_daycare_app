<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
use App\Models\Media;
use App\Models\Post;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('media')->delete();

        for ($i = 0; $i <= 1; $i++) {
            $post = Post::inRandomOrder()->first();
            $url = 'https://picsum.photos/600/500';
            $post
            ->addMediaFromUrl($url)
            ->toMediaCollection();
        }
    }
}
