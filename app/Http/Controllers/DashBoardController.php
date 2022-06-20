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
use App\Models\Diary;
use App\Models\User;
use App\Models\Notification;

use Illuminate\Validation\Rule;
use App\Events\NewComment as NewComment;
use App\Events\NewPost as NewPost;


class DashBoardController extends Controller
{

    // GET ALL CLIENTS
    public function getClients(){
        $clients = Client::leftJoin('client_main_users', function($join) {
            $join->on('clients.id', '=', 'client_main_users.client_id');
          })->where('main_user_id',Auth()->user()->main_user_id)->get();
        return $this->getPost($clients);
    }

    // CHILDREN PAGE WITH ALL CLIENTS
    public function index() {
        $notifications = $this->get_notifications();
        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        $children = Client::with('main_users')->whereRelation('companies', 'companies.id', $company_id)->get();
        return view('dashboard', compact('children', 'notifications'));
    }

    // PARENTS PAGE WITH ALL MAIN_USERS
    public function show_parents() {
        $notifications = $this->get_notifications();
        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        $main_users = MainUser::with('clients', 'companies')->whereRelation('companies', 'companies.id', $company_id)->get();
        return view('parents', compact('main_users', 'notifications'));
    }

    // CREATE A NEW PARENT WITH FIRST CHILD
    public function store_parent(Request $request) {
        // GET THE ENTERED CODE
        $main_user_code = $request->main_user_code;

        // VALIDATE USER INPUTS
        $request->validate([
            'main_user_code' => [
                'required',
                Rule::exists('main_users')->where('main_user_code', $main_user_code), // CHECK IF ENTERED CODE EXISTS
            ],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'age' => ['required', 'numeric'],
            'client_pic' => ['required']
        ]);

        // GET THE MAIN USER LINKED WITH HIS CODE
        $main_user = MainUser::where('main_user_code', $request->input('main_user_code'))->first();
        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;

        // CREATE THE CHILD
        $client = Client::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'age' => $request->input('age'),
            'checked_in' => 0
        ]);

        // ADD PROFILE PICTURE TO CHILD
        $client->addMedia($request->file('client_pic'))->toMediaCollection();

        // LINK CHILD AND PARENT AND COMPANY
        $parentAdd = ClientMainUser::create([
            'client_id' => $client->id,
            'main_user_id' => $main_user->id,
            'company_id' => $company_id
        ]);

        // GO TO CREATED PARENT DETAIL PAGE
        return redirect('parent/'.$main_user->id);
    }

    public function parent_detail($main_user_id) {
        $notifications = $this->get_notifications();
        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        $main_user = MainUser::with('clients', 'user')->where('id', $main_user_id)->first();
        $company = Company::with('main_users')->where('id', $company_id)->first();

        // ROUTE WITH ID CAN ONLY BE ACCESSED WHEN MAIN_USER_ID BELONGS TO THE LOGGED IN COMPANY
        if ($company->main_users()->find($main_user->id)) {
            return view('mainuserdetail', compact('main_user', 'company_id', 'notifications'));
        } else {
            return redirect('/parents');
        }
    }

    // NOT USED NOW
    public function show_children() {

        $children = Client::get();
        return view('dashboard', compact('children'));
    }

    // POST A NEW CHILD
    public function store_child(Request $request) {

        // VALIDATE USER INPUTS
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
        $notifications = $this->get_notifications();
        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        $posts = Post::with('comments.company', 'comments.main_user', 'companies')->
        where('company_id', $company_id)->
        orderby('posts.created_at', 'DESC')->get();
        $clients = Client::all();

        return view('posts', compact('posts', 'clients', 'notifications'));
    }

    public function store_post(Request $request) {

        $company_acount = User::with('company', 'company.main_users')->where('id', Auth::id())->first();
        $main_users = $company_acount->company->main_users;
        $user_array = array();

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

        foreach ($request->file('images') as $image) {
            $post->addMedia($image->path())->toMediaCollection();
        }

        foreach ($main_users as $main_user) { 
            $user_array [] = $main_user->id;
            Notification::firstOrCreate([
                'main_user_id' => $main_user->id,
                'company_id' => null,
                'model_type' => get_class($post),
                'model_id' => $post->id
            ]);
        }


        event(new NewPost(Auth::user()->name, $user_array, $post->id));

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
        Notification::where('model_id', $post->id)->where('model_type', 'App\Models\Post')->delete();
        $post->delete();
        return redirect('/posts');
    }

    public function show_diaries() {
        $notifications = $this->get_notifications();
        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        $diaries = Diary::where('company_id', $company_id)->get();

        return view('diaries', compact('diaries', 'notifications'));
    }

    public function diary_detail($diary_id) {
        $notifications = $this->get_notifications();
        $diary = Diary::where('id', $diary_id)->first();
        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        $company = Company::with('diaries')->where('id', $company_id)->first();
        if ($company->diaries()->find($diary->id)) {
            return view('diarydetails', compact('diary', 'notifications'));
        } else {
            return redirect('/diaries');
        }
    }

    public function destroy_diary(Diary $diary) {
        $diary->delete();
        return redirect(url()->previous());
    }

    public function store_comment(Request $data) {

    $company_acount = User::with('company', 'company.main_users')->where('id', Auth::id())->first();
    $main_users = $company_acount->company->main_users;
    $user_array = array();

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

    foreach ($main_users as $main_user) { 
        $user_array[] = $main_user->id;
        Notification::firstOrCreate([
            'main_user_id' => $main_user->id,
            'company_id' => null,
            'model_type' => get_class($comment),
            'model_id' => $comment->id
        ]);

        Notification::firstOrCreate([
            'main_user_id' => null,
            'company_id' => Auth::user()->company_id,
            'model_type' => get_class($comment),
            'model_id' => $comment->id
        ]);
    }

    event(new NewComment(Auth::user()->name, $user_array, $comment->id));

    return $comment->id;

    }

    public function destroy_comment(Comment $comment) {
        Notification::where('model_id', $comment->id)->where('model_type', 'App\Models\Comment')->delete();
        $comment->delete();

        return "deleted succesfully";
    }



     public function store_diary(Request $request) {

        Diary::create([
        'food_message' => $request->input('food_message'),
        'food_smile' => $request->input('food_smile'),
        'sleep_message' => $request->input('sleep_message'),
        'sleep_smile' => $request->input('sleep_smile'),
        'poop_icons' => $request->input('poop_icons'),
        'mood' => $request->input('mood'),
        'activity_message' => $request->input('activity_message'),
        'involvement_message' => $request->input('involvement_message'),
        'extra_message' => $request->input('extra_message'),
        'company_id' => Auth::user()->company_id,
        'client_id' => $request->input('client_id')
    ]);


    return redirect('/dashboard');
}

public function get_notifications() {
    $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
    $main_users = MainUser::with('clients', 'companies')->whereRelation('companies', 'companies.id', $company_id)->get();
    $main_users_array = array();
    foreach ($main_users as $main_user) {
        $main_users_array[] = $main_user->id;
    }
    $notification_array = array();
    $user_notifications = Notification::where('company_id', $company_id)->get()->sortByDesc('created_at');
    foreach ($user_notifications as $user_notification) {
        switch ($user_notification->model_type) {
          case "App\Models\Post":
            $post_author = Post::find($user_notification->model_id)->companies->name;
            $notification_array[] = [Post::find($user_notification->model_id), $post_author];
            break;
          case "App\Models\Comment":
            $comment_author = "";
            $notification_array[] = [Comment::find($user_notification->model_id), $comment_author];
            break;
        }
      }

      return $notification_array;
}

public function mark_notifications_as_read() {
    $company_id = Auth()->user()->company->id;
    Notification::where('company_id', $company_id)->delete();

    return redirect()->route('dashboard');
  }

}
