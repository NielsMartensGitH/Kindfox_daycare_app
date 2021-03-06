<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;


// OUR MODELS
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

// FOR VALIDATION TO CHECK IF SOMETHING EXISTS IN A TABLE
use Illuminate\Validation\Rule;

// EVENTS FOR NOTIFICATIONS
use App\Events\NewComment as NewComment;
use App\Events\NewPost as NewPost;


class DashBoardController extends Controller
{

    // THIS METHOD GETS ALL THE CLIENTS
    public function getClients(){
        $clients = Client::leftJoin('client_main_users', function($join) {
            $join->on('clients.id', '=', 'client_main_users.client_id');
          })->where('main_user_id',Auth()->user()->main_user_id)->get();
        return $this->getPost($clients);
    }

    // THIS MESSAGE SHOWS CHILDREN PAGE WITH ALL CLIENTS
    public function index() {

        // WE NEED THE NOTIFICATIONS HERE FOR THE NAVBAR DROPDOWN
        $notifications = $this->get_notifications();


        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        $children = Client::with('main_users')->whereRelation('companies', 'companies.id', $company_id)->get();
        return view('dashboard', compact('children', 'notifications'));
    }

    // METHOD THAT SHOWS ALL MAIN_USERS
    public function show_parents() {

        // WE NEED THE NOTIFICATIONS HERE FOR THE NAVBAR DROPDOWN
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

    // THIS METHOD SHOWS DETAIL OF INDIVIDUAL PARENT
    public function parent_detail($main_user_id) {

        // WE NEED THE NOTIFICATIONS HERE FOR THE NAVBAR DROPDOWN
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

        // CREATE OUR NEW CHILD
        $client = Client::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'age' => $request->input('age'),
            'checked_in' => 0
        ]);

        // ADD PICTURE TO THAT CHILD TO MEDIACOLLECTION (USES MEDIALIBRARY FROM SPATIE)
        $client->addMedia($request->file('client_pic'))->toMediaCollection();

        // LINK CHILD TO COMPANY AND CLIENT BY CREATING NEW LINE IN OUR PIVOT TABLE
        ClientMainUser::create([
            'client_id' => $client->id,
            'main_user_id' => $request->input('main_user_id'),
            'company_id' => Auth::user()->company_id
        ]);

        return redirect('parent/'.$request->input('main_user_id'));

    }

    // METHOD FOR EDITING A CHILD BY FILLING IN A EDITING FORM
    public function edit_client(Request $request, Client $client) {

        // FORM VALIDATION OF USER INPUTS
        $updatePost = $request->validate([
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'age' => ['required', 'string']
        ]);

        // UPDATE OUR CHILD
        $client->update($updatePost);

        // RETURN TO THE PREVIOUS PAGE THEN
        return redirect(url()->previous());
    }

    // METHOD FOR DELETING A CHILD
    public function destroy_client(Client $client, $user_id = null) { // USER ID IS OPTIONAL PARAMETER
        $client->delete();
        if($user_id) { // IF WE ARE ON USER DETAIL PAGE WE GO TO THAT DETAIL PAGE AGAIN AFTER DELETION
            return redirect('parent/'.$user_id);
        } else { // ELSE WE GO TO THE MAIN DASHBOARD PAGE WERE YOU COULD ALSO DELETE A CHILD
            return redirect('dashboard');
        }
    }

    // METHOD WHICH UPDATES THE CHECKED_IN STATUS OF A CHILD
    public function update_child_status(Request $request, Client $client) {
        /*
        $updatePost = $request->validate([
            'checked_in' => ['required']
        ]);
        */
        //dd($updatePost);
        //$client->update($updatePost);
        if($client->checked_in == 1){
            $client->checked_in = 0;
            //dd('checked out');
        }
        else{
            $client->checked_in = 1;
            //dd('checked in');
        }
        $client->save();

        //dd($client);
        return redirect(url()->previous());
    }


    // METHOD WHICH SHOWS OUR POSTS
    public function show_posts() {


        // WE NEED THE NOTIFICATIONS HERE FOR THE NAVBAR DROPDOWN
        $notifications = $this->get_notifications();

        // WE GET ONLY THE POSTS WHICH BELONG TO OUR COMPANY AND WE ORDER THEM SO WE SEE THE NEWEST POSTS ABOVE
        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        session(['company_id' => $company_id]);

        $posts = Post::with('comments.company', 'comments.main_user', 'companies')->
        where('company_id', $company_id)->
        orderby('posts.created_at', 'DESC')->get();

        $clients = Client::whereHas('companies', function(Builder $query) {
            $query->where('companies.id', session('company_id'));
        })->get();

        return view('posts', compact('posts', 'clients', 'notifications'));
    }

    // METHOD TO STORE A NEW POSTS
    public function store_post(Request $request) {

        // OUR COMPANY DATA
        $company_acount = User::with('company', 'company.main_users')->where('id', Auth::id())->first();
        // LINKED PARENTS FROM THAT COMPANY
        $main_users = $company_acount->company->main_users;
        $user_array = array(); // ARRAY OF USERS TO STORE ALL COMPANY PARENTS SO ONLY THEY RECEIVE NOTIFICATION OF NEW POST

        // VALIDATION OF USER INPUTS
        $request->validate([
            'privacy' => ['required', 'integer'],
            'client_id' => ['nullable', 'integer'],
            'images' => ['required', 'array'],
            'images.*' => ['nullable'],
            'message' => ['required', 'string']
        ]);

        // CREATING OUR NEW POST
        $post = Post::create([
            'message' => $request->input('message'),
            'company_id' => Auth::user()->company_id,
            'is_private' => $request->input('privacy'),
        ]);

        // BECAUSE WE CAN HAVE MULTIPLE IMAGES WE NEED TO ADD THEM ONE BY ONE TO MEDIACOLLECTION LIBRARY
        foreach ($request->file('images') as $image) {
            $post->addMedia($image->path())->toMediaCollection();
        }

        // EACH MAINUSER NEED A NOTIFICATION
        foreach ($main_users as $main_user) { 
            $user_array [] = $main_user->id;
            Notification::firstOrCreate([
                'main_user_id' => $main_user->id,
                'company_id' => null,
                'model_type' => get_class($post),
                'model_id' => $post->id
            ]);
        }

        // THIS IS AN EVENT WHICH WILL TRIGGER A LIVE NOTIFICATION ON USERS MESSAGEBOARD AND COMPANY DASHBOARD
        event(new NewPost(Auth::user()->name, $user_array, $post->id)); // WE ADDED SOME DATA TO NEWPOST OBJECT WE NEED TO USE FURTHER

        return redirect('/posts');
    }

    // METHOD FOR EDITING AN EXISTING POST
    public function edit_post(Request $request, Post $post) {
        // USER INPUT VALIDATION
        $updatePost = $request->validate([
            'privacy' => ['required', 'integer'],
            'client_id' => ['nullable', 'integer'],
            'message' => ['required', 'string']
        ]);

        // UPDATE OUR POST
        $post->update($updatePost);

        return redirect('/posts');
    }

    // METHOD FOR DELETING A POST
    public function destroy_post(Post $post) {

        // WHEN WE DELETE A POST WE HAVE TO MAKE SURE OUR NOTIFICATION GETS ALSO DELETED!
        Notification::where('model_id', $post->id)->where('model_type', 'App\Models\Post')->delete();

        // DELETE THAT POST
        $post->delete();
        return redirect('/posts');
    }

    // METHOD FOR SHOWING OUR DIARIES TABLE
    public function show_diaries() {


         // WE NEED THE NOTIFICATIONS HERE FOR THE NAVBAR DROPDOWN
         $notifications = $this->get_notifications();

        // ONLY THE DIARIES SHOULD BE SHOWN THAT ARE LINKED TO OUR COMPANY
        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        $diaries = Diary::where('company_id', $company_id)->get();

        return view('diaries', compact('diaries', 'notifications'));
    }

    // METHOD FOR SHOWING DETAILS OF AN INDIVIDUAL DIARY
    public function diary_detail($diary_id) {
         // WE NEED THE NOTIFICATIONS HERE FOR THE NAVBAR DROPDOWN
         $notifications = $this->get_notifications();


        // WE CAN ONLY SHOW THE DIARY THAT IS LINKED TO THE COMPANY , WHEN USERS TRIES TO ADD AN ID TO ROUTE
        // THAT DOES NOT BELONG TO OUR COMPANY HE WILL BE REDIRECTED TO THE MAIN DIARIES PAGE
        $diary = Diary::where('id', $diary_id)->first();
        $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
        $company = Company::with('diaries')->where('id', $company_id)->first();
        if ($company->diaries()->find($diary->id)) {
            return view('diarydetails', compact('diary', 'notifications'));
        } else {
            return redirect('/diaries');
        }
    }

    // METHOD FOR DELETING A DIARY
    public function destroy_diary(Diary $diary) {
        $diary->delete();
        return redirect(url()->previous());
    }


    // METHOD FOR ADDING A COMMENT WITH AJAX
    public function store_comment(Request $data) {

    $company_acount = User::with('company', 'company.main_users')->where('id', Auth::id())->first();
    $main_users = $company_acount->company->main_users;
    $user_array = array(); // ARRAY OF USERS TO STORE ALL COMPANY PARENTS SO ONLY THEY RECEIVE NOTIFICATION OF NEW POST

    // CREATE A NEW COMMENT
    $comment = Comment::create([
        'message' => $data->message,
        'main_user_id' => null,
        'company_id' => $data->company_id
    ]);

    // CREATE LINK WITH POST BY ADDING THIS ROW ON PIVOT TABLE
    CommentPost::create([
        'comment_id' => $comment->id,
        'dairy_id' => null,
        'post_id' => $data->commentPost_id
    ]);


    // CREATING NOTIFICATION FOR EACH USER
    foreach ($main_users as $main_user) { 
        $user_array[] = $main_user->id;
        Notification::firstOrCreate([
            'main_user_id' => $main_user->id,
            'company_id' => null,
            'model_type' => get_class($comment),
            'model_id' => $comment->id
        ]);

        // CREATING NOTIFICATION FOR THE COMPANY
        Notification::firstOrCreate([
            'main_user_id' => null,
            'company_id' => Auth::user()->company_id,
            'model_type' => get_class($comment),
            'model_id' => $comment->id
        ]);
    }

    // THIS IS AN EVENT WHICH WILL TRIGGER A LIVE NOTIFICATION ON USERS MESSAGEBOARD AND COMPANY DASHBOARD
    event(new NewComment(Auth::user()->name, $user_array, $comment->id)); // WE ADDED SOME DATA TO NEWCOMMENT OBJECT WE NEED TO USE FURTHER

    return $comment->id;

    }

    // METHOD FOR DELETING A COMMENT WITH AJAX
    public function destroy_comment(Comment $comment) {
        Notification::where('model_id', $comment->id)->where('model_type', 'App\Models\Comment')->delete();
        $comment->delete();

        return "deleted succesfully";
    }


    // METHOD FOR ADDING A NEW DIARY
     public function store_diary(Request $request) {

        // VALIDATION FOR USER INPUTS
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

// METHOD WHICH GETS ALL UNREAD NOTIFICATIONS
public function get_notifications() {
    $company_id = User::with('company')->where('id', Auth::id())->first()->company->id;
    $main_users = MainUser::with('clients', 'companies')->whereRelation('companies', 'companies.id', $company_id)->get();

    // HERE WE STORE ALL THE MAINUSERS ID'S OF OUR COMPANY
    $main_users_array = array();
    foreach ($main_users as $main_user) {
        $main_users_array[] = $main_user->id;
    }

    // HERE WE STORE ALL OUR POST AND COMMENT NOTIFICATIONS
    $notification_array = array();
    $user_notifications = Notification::where('company_id', $company_id)->get()->sortByDesc('created_at');
    foreach ($user_notifications as $user_notification) {
        switch ($user_notification->model_type) {
          case "App\Models\Post": // POLYMORPHIC RELATION WITH MODEL POST
            $post_author = Post::find($user_notification->model_id)->companies->name;
            $notification_array[] = [Post::find($user_notification->model_id), $post_author]; // NOW WE KNOW POST_ID AND AUTHOR
            break;
          case "App\Models\Comment": // POLYMORPHIC RELATION WITH COMMENT
            $comment_author = "";
            $notification_array[] = [Comment::find($user_notification->model_id), $comment_author]; // NOW WE KNOW POST_ID AND AUTHOR
            break;
        }
      }

    return $notification_array;
}

// METHODS WHICH DELETES ALL NOTIFICATIONS OF A COMPANY IN NOTIFICATION TABLE WHEN CLIKING 'Mark as read'
public function mark_notifications_as_read() {
    $company_id = Auth()->user()->company->id;
    Notification::where('company_id', $company_id)->delete();

    return redirect()->route('dashboard');
  }

}
