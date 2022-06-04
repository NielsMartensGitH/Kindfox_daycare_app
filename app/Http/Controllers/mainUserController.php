<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Company;
use App\Models\MainUser;
use App\Models\Client;

class mainUserController extends Controller
{
    //MAINCONTENT
    public function getPost($clients){
        $MU_id = Auth()->user()->main_user_id;

        //GET CLIENT INFO WITH LINKED COMPANY
        $mainUserInfo = MainUser::with('companies')->where('id', $MU_id)->get();
        
        //REPLACE THE CLIENT ID WITH VERIFIED LOGIN ID
        $posts = Post::with('companies')->where('is_private',0)->orWhere('is_private',1)->where('client_id',Auth()->user()->main_user_id)->get();
        
        //Here we join the comment table with the pivot table to be able to get the post_id
        $postcomments = Comment::leftJoin('comment_posts', function($join) {
            $join->on('comments.id', '=', 'comment_posts.comment_id');
          })->get();
        $companies = Company::get();

        //these are the diffrent test to see what's in there
        //dd(Auth()->user()->main_user_id);
        //dd($mainUserInfo);
        //dd($posts);
        //dd($postcomments);
        //dd($clients);
        //this returns the needed values to the view
        return view('mainuserview',['Posts' => $posts, 'Comments' => $postcomments, 'Companies' => $companies, 'User' => $mainUserInfo, 'Clients' => $clients]);
    }
    public function getClients(){
        $clients = Client::leftJoin('client_main_users', function($join) {
            $join->on('clients.id', '=', 'client_main_users.client_id');
          })->where('main_user_id',Auth()->user()->main_user_id)->get();

        return $this->getPost($clients);
    }




    //SINGLE CLIENT STUFF
    public function getDiaries($id){
      return view('MainUserViewDiary');
    }
}
