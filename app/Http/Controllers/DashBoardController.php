<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\MainUser;

class DashBoardController extends Controller
{
    public function getClients(){
        $clients = Client::leftJoin('client_main_users', function($join) {
            $join->on('clients.id', '=', 'client_main_users.client_id');
          })->where('main_user_id',Auth()->user()->main_user_id)->get();
        return $this->getPost($clients); 
    }
    public function index() {
        return view('dashboard', ['Clients' => $clients]);
    }

    public function show_parents() {

        $main_users = MainUser::with('clients')->get();
        return view('parents', compact('main_users'));
    }

    public function show_calendar() {
        return view('calendar');
    }

    public function show_posts() {

        $posts = Post::with('comments', 'companies')->get();
        return view('posts', compact('posts'));
    }

    public function show_diaries() {

        $data = 'this is my data';

        return view('diaries', compact('data'));
    }
}
