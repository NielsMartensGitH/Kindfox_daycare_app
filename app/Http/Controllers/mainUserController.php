<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Company;
use App\Models\MainUser;

class mainUserController extends Controller
{
    //
    public function getPost(){
        //GET CLIENT INFO WITH LINKED COMPANY
        $clientinfo = MainUser::with('companies')->where('id', 6 )->get();
        dd($clientinfo);
        //REPLACE THE CLIENT ID WITH VERIFIED LOGIN ID
        $posts = Post::with('companies')->where('is_private',0)->where('company_id',3)->orWhere('is_private',1)->where('client_id',6)->get();
        
        //Here we join the comment table with the pivot table to be able to get the post_id
        $postcomments = Comment::leftJoin('comment_posts', function($join) {
            $join->on('comments.id', '=', 'comment_posts.comment_id');
          })->get();
        $companies = Company::get();
        // dd($posts);
        //dd($postcomments);
        return view('mainuserview',['Posts' => $posts, 'Comments' => $postcomments, 'Companies' => $companies, 'User' => $user]);
    }
}
