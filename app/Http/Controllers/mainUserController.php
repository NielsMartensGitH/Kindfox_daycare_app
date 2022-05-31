<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class mainUserController extends Controller
{
    //
    public function getPost(){
        //REPLACE THE CLIENT ID WITH VERIFIED LOGIN ID
        $posts = Post::get()->where('is_private',0);
        dd($posts);
    }
}
