<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\MainUser;

class DashBoardController extends Controller
{
    public function index() {
        return view('dashboard');
    }

    public function show_parents() {

        $main_users = MainUser::with('clients')->get();
        return view('parents', compact('main_users'));
    }

    public function show_calendar() {
        return view('calendar');
    }

    public function show_posts() {

        $posts = Post::with('comments.company', 'comments.main_user', 'companies')->get();

        return view('posts', compact('posts'));
    }

    public function show_diaries() {

        $data = 'this is my data';

        return view('diaries', compact('data'));
    }
}
