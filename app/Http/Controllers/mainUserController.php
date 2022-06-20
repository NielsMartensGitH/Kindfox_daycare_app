<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\CommentPost;
use App\Models\Company;
use App\Models\MainUser;
use App\Models\Client;
use App\Models\Diary;
use App\Models\Notification;
use Illuminate\Support\Str;
use App\Models\User;
use App\Events\NewUserComment as NewUserComment;
use App\Events\NewPost as NewPost;

class mainUserController extends Controller
{
    //MAINCONTENT
    public function getPost($mainUserInfo, $MU_id, $clients, $notification_array){

        $posts = Post::with('comments', 'companies')->orderby('posts.created_at', 'DESC')->get();

        //Here we join the comment table with the pivot table to be able to get the post_id
        $postcomments = Comment::leftJoin('comment_posts', function($join) {
            $join->on('comments.id', '=', 'comment_posts.comment_id');
          })->get();
        $companies = Company::get();

        //this returns the needed values to the view
        return view('mainuserview',['posts' => $posts, 'comments' => $postcomments, 'companies' => $companies, 'user' => $mainUserInfo, 'clients' => $clients, 'notifications' => $notification_array]);
    }

    //SINGLE CLIENT STUFF
    public function getDiaries($id, $MU_id, $mainUserInfo, $clients, $notification_array){

      $curClient = Client::where('id',$id)->first();

      $diary = Diary::where('client_id',$id)->get();

      if($diary->isEmpty()){
        $company = null;
        //dd($diary);
      }
      else{
        $company = Company::where('id',$diary[0]->company_id)->first();
      }
      //dd(count($clients));
      //dd($diary);
      $companies = Company::get();
      for($i = 0; $i <= count($clients)-1; $i++){
        if($clients[$i]->client_id == $id){
          return view('mainuserviewdiary',['Diaries' => $diary, 'Company' =>$company, 'clients' => $clients, 'curClient' => $curClient, 'User' => $mainUserInfo, 'notifications' => $notification_array]);
        }
      }
      dd($id);
      return redirect()->route('mainuserview');
      //dd($company);

    }

    public function getMainUserInfo($mainUserInfo, $MU_id, $clients, $notification_array){
      //$MU_id = Auth()->user()->main_user_id;

      $Userdata = MainUser::where('id',$MU_id)->get();

      return view('mainuserSettings',['Userdata' => $Userdata,'user' => $mainUserInfo,'clients' => $clients, 'notifications' => $notification_array]);
    }

    public function updateMainUser(Request $request, MainUser $id){
      //dd($request->path());
      $updateUser = $request->validate([
        'first_name' => ['required', 'string'],
        'last_name' => ['required', 'string'],
        'streetnr' => ['required', 'string'],
        'country' => ['required', 'string'],
        'postal_code' => ['required', 'string'],
        'city' => ['required', 'string'],
        'phone' => ['required', 'string']
      ]);
      
      $usertable = User::where('main_user_id',$id->id)->first();
      //dd($request->first_name);
      //dd($usertable);
      //dd($id);
      $usertable->name = $request->first_name;
      $usertable->save();
      //$usertable->update(['name', $request->first_name]);
      $id->update($updateUser);
      //dd($updateUser);
      return redirect('usersettings');
    }


    //REDUX OF CURRENT CODE
    public function mainPageNeeded(Request $request){
      //dd($request->path());

      // COMMON \\
      //get client id and info
      $MU_id = Auth()->user()->main_user_id;
      $mainUserInfo = MainUser::with('companies')->distinct()->where('id', $MU_id)->get(); // get mainuserinfo
      $notification_array = array(); // initiate empty array for notifications
      // only notifications for the logged in mainuser
      $user_notifications = Notification::where('main_user_id', $mainUserInfo[0]->id)->get(); 

      foreach ($user_notifications as $user_notification) {
        switch ($user_notification->model_type) {
          case "App\Models\Post":
            $post_author = Post::find($user_notification->model_id)->companies->name;
            $notification_array[] = [Post::find($user_notification->model_id), $post_author] ;
            break;
          case "App\Models\Comment":
            $comment_author = "";
            $notification_array[] = [Comment::find($user_notification->model_id), $comment_author];
            break;
        }
      }
      //get the clients connected to the user if he has an main user id
      if(!is_null($MU_id)){
        $clients = Client::leftJoin('client_main_users', function($join) {
          $join->on('clients.id', '=', 'client_main_users.client_id');
        })->where('main_user_id',Auth()->user()->main_user_id)->get();
      }
      else{
        $clients = null;
      }

      $location = $request->path();

      if(Str::contains($location,'diaries/')){
        $id = explode("/",$location);
        return $this->getDiaries($id[1], $MU_id, $mainUserInfo, $clients, $notification_array);
      }
      elseif(Str::contains($location,'usersettings')){
        return $this->getMainUserInfo($mainUserInfo, $MU_id, $clients, $notification_array);
      }
      else{
        return $this->getPost($mainUserInfo, $MU_id, $clients, $notification_array);
      }
      return view('mainuserview');
    }

    public function mark_notifications_as_read() {
      $user_id = Auth()->user()->main_user_id;
      Notification::where('main_user_id', $user_id)->delete();

      return redirect()->route('mainuserview');
    }

    public function store_comment(Request $data) {


      $user_array = array();

      $MU_id = Auth()->user()->main_user_id;
      $mainUserInfo = MainUser::with('companies')->distinct()->where('id', $MU_id)->first();
      $company_id = $mainUserInfo->companies->first()->id;

      $new_comment = Comment::create([
          'message' => $data->message,
          'main_user_id' => $data->company_id,
          'company_id' => null
      ]);
      CommentPost::create([
          'comment_id' => $new_comment->id,
          'dairy_id' => null,
          'post_id' => $data->commentPost_id
      ]);

      $post_comments = Comment::find($new_comment->id)->posts()->first()->comments()->get();

      foreach ($post_comments as $comment) {
        if (!in_array($comment->main_user_id, $user_array)) {
          $user_array[] = $comment->main_user_id;
        Notification::firstOrCreate([
          'main_user_id' => $mainUserInfo->id,
          'company_id' => null,
          'model_type' => get_class($comment),
          'model_id' => $new_comment->id
        ]);
        }
      }

      Notification::firstOrCreate([
        'main_user_id' => null,
        'company_id' => $company_id,
        'model_type' => get_class($new_comment),
        'model_id' => $new_comment->id
      ]);

      event(new NewUserComment(Auth::user()->name, $user_array, $comment->id, $company_id));

      return $comment->id;

    }
}
