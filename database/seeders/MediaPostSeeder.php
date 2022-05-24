<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Media;
use App\Models\Post;
use App\Models\MediaPost;
use Illuminate\Support\Arr;

class MediaPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('media_posts')->delete();
        $faker = Factory::create('nl_BE');
        $post_ids = Post::all()->pluck('id')->toArray();
        $media_ids = Media::all()->pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            $media_id = Arr::random($media_ids);
            $post_id = Arr::random($post_ids);

            MediaPost::create([
                'media_id' => $media_id,
                'post_id' => $post_id
            ]);
        }
    }
}
