<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Company;

class mainUserController extends Controller
{
    //
    public function getPost(){
        //REPLACE THE CLIENT ID WITH VERIFIED LOGIN ID
        $posts = Post::where('is_private',0)->where('company_id',3)->orWhere('is_private',1)->where('client_id',6)->get();
        //NEEDS JOIN TO SEE TO WHICH POST IT IS ASSIGNED
        $postcomments = Comment::get();
        $companies = Company::get();
        // dd($posts);
        //dd($postcomments);
        return view('mainuserview',['Posts' => $posts, 'Comments' => $postcomments, 'Companies' => $companies]);
    }
}
