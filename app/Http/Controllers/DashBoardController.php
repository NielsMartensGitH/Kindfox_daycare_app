<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\MainUser;
use App\Models\ClientMainUser;
use App\Models\Client;
use App\Models\Company;
use App\Models\Comment;
use App\Models\CommentPost;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Validation\Rule;


class DashBoardController extends Controller
{
    public function getClients(){
        $clients = Client::leftJoin('client_main_users', function($join) {
            $join->on('clients.id', '=', 'client_main_users.client_id');
          })->where('main_user_id',Auth()->user()->main_user_id)->get();
        return $this->getPost($clients);
    }

    public function index() {
        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        $children = Client::with('main_users')->whereRelation('companies', 'companies.id', $company_id)->get();
        return view('dashboard', compact('children'));
    }

    public function show_parents() {

        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        $main_users = MainUser::with('clients', 'companies')->whereRelation('companies', 'companies.id', $company_id)->get();
        return view('parents', compact('main_users'));
    }

    public function store_parent(Request $request) {

        $main_user_code = $request->main_user_code;

        $request->validate([
            'main_user_code' => [
                'required',
                Rule::exists('main_users')->where('main_user_code', $main_user_code),
            ],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'age' => ['required', 'numeric'],
            'client_pic' => ['required']
        ]);

        $main_user = MainUser::where('main_user_code', $request->input('main_user_code'))->first();
        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;

        $client = Client::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'age' => $request->input('age'),
            'checked_in' => 0
        ]);

        $client->addMedia($request->file('client_pic'))->toMediaCollection();

        $parentAdd = ClientMainUser::create([
            'client_id' => $client->id,
            'main_user_id' => $main_user->id,
            'company_id' => $company_id
        ]);

        return redirect('parent/'.$main_user->id);
    }

    public function parent_detail($main_user_id) {

        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        $main_user = MainUser::with('clients', 'user')->where('id', $main_user_id)->first();

        $company = Company::with('main_users')->where('id', $company_id)->first();

        if ($company->main_users()->find($main_user->id)) {
            return view('mainuserdetail', compact('main_user', 'company_id'));
        } else {
            return redirect('/parents');
        }
    }

    public function show_children() {

        $children = Client::get();
        return view('dashboard', compact('children'));
    }

    public function store_child(Request $request) {

        $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'age' => ['required', 'string'],
            'client_pic' => ['required']
        ]);

        $client = Client::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'age' => $request->input('age'),
            'checked_in' => 0
        ]);

        $client->addMedia($request->file('client_pic'))->toMediaCollection();

        ClientMainUser::create([
            'client_id' => $client->id,
            'main_user_id' => $request->input('main_user_id'),
            'company_id' => Auth::user()->company_id
        ]);

        return redirect('parent/'.$request->input('main_user_id'));

    }

    public function edit_client(Request $request, Client $client) {
        $updatePost = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'age' => ['required', 'string']
        ]);

        $client->update($updatePost);

        return redirect(url()->previous());
    }

    public function destroy_client(Client $client, $user_id = null) {
        $client->delete();
        if($user_id) {
            return redirect('parent/'.$user_id);
        } else {
            return redirect('dashboard');
        }
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
