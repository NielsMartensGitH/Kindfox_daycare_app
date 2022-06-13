<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\MainUser;
use App\Models\Client;
use App\Models\Comment;
use App\Models\CommentPost;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class DashBoardController extends Controller
{
    public function getClients(){
        $clients = Client::leftJoin('client_main_users', function($join) {
            $join->on('clients.id', '=', 'client_main_users.client_id');
          })->where('main_user_id',Auth()->user()->main_user_id)->get();
        return $this->getPost($clients);
    }

    public function index() {
        $children = Client::with('main_users')->get();
        return view('dashboard', compact('children'));
    }

    public function show_parents() {

        $main_users = MainUser::with('clients')->get();
        return view('parents', compact('main_users'));
    }

    public function store_parent() {
        dd("check!");
    }

    public function show_children() {

        $children = Client::get();
        return view('dashboard', compact('children'));
    }

    public function show_calendar() {
        return view('calendar');
    }

    public function show_posts() {

        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        $posts = Post::with('comments.company', 'comments.main_user', 'companies')->
        where('company_id', $company_id)->
        orderby('posts.created_at', 'DESC')->get();
        $clients = Client::all();

        return view('posts', compact('posts', 'clients'));
    }

    public function store_post(Request $request) {

        $request->validate([
            'privacy' => ['required', 'integer'],
            'client_id' => ['nullable', 'integer'],
            'images' => ['required', 'array'],
            'images.*' => ['nullable'],
            'message' => ['required', 'string']
        ]);

        $post = Post::create([
            'message' => $request->input('message'),
            'company_id' => Auth::user()->company_id,
            'is_private' => $request->input('privacy'),
        ]);

        foreach($request->file('images') as $image) {
            $post->addMedia($image->path())->toMediaCollection();
        }

        return redirect('/posts');
    }

    public function edit_post(Request $request, Post $post) {
        $updatePost = $request->validate([
            'privacy' => ['required', 'integer'],
            'client_id' => ['nullable', 'integer'],
            'message' => ['required', 'string']
        ]);

        $post->update($updatePost);

        return redirect('/posts');
    }

    public function destroy_post(Post $post) {
        $post->delete();
        return redirect('/posts');
    }

    public function show_diaries() {

        return view('diaries');
    }

    public function store_comment(Request $data) {

    $comment = Comment::create([
        'message' => $data->message,
        'main_user_id' => null,
        'company_id' => $data->company_id
    ]);
    CommentPost::create([
        'comment_id' => $comment->id,
        'dairy_id' => null,
        'post_id' => $data->commentPost_id
    ]);

    return $comment->id;
    }

}
