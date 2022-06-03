<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('posts');
    }

    public function show_diaries() {


        $data = 'this is my data';

        return view('diaries', compact('data'));
    }
}
