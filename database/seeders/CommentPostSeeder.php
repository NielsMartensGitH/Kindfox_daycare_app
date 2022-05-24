<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\Diary;
use App\Models\Post;
use App\Models\CommentPost;
use Illuminate\Support\Arr;


class CommentPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comment_posts')->delete();
        $faker = Factory::create('nl_BE');
        $comment_ids = Comment::all()->pluck('id')->toArray();
        $post_ids = Post::all()->pluck('id')->toArray();
        array_push($post_ids, null);
        $diary_ids = Diary::all()->pluck('id')->toArray();

        for ($i = 0; $i < 20 ; $i++) {
         $comment_id = Arr::random($comment_ids);
         $post_id = Arr::random($post_ids);
         $diary_id = $post_id ? null : Arr::random($diary_ids);
         CommentPost::create([
            'comment_id' => $comment_id,
            'diary_id' => $diary_id,
            'post_id' => $post_id
        ]);
        }
    }
}
