<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
