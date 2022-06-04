<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class DashBoardController extends Controller
{
    public function index() {
        return view('dashboard');
    }

    public function show_parents() {
        return view('parents');
    }

    public function show_calendar() {
        return view('calendar');
    }

    public function show_posts() {

        $posts = Post::with('comments')->get();
        return view('posts', compact('posts'));
    }

    public function show_diaries() {

        $data = 'this is my data';

        return view('diaries', compact('data'));
    }
}
