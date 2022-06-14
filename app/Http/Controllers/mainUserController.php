<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Company;
use App\Models\MainUser;
use App\Models\Client;
use App\Models\Diary;
use Illuminate\Support\Str;

class mainUserController extends Controller
{
    //MAINCONTENT
    public function getPost($mainUserInfo, $MU_id, $clients){
        //$MU_id = Auth()->user()->main_user_id;

        //GET CLIENT INFO WITH LINKED COMPANY
        //$mainUserInfo = MainUser::with('companies')->distinct()->where('id', $MU_id)->get();
        
        $posts = Post::with('comments', 'companies')->get();
        //$posts = Post::with('companies')->where('is_private',0)->orWhere('is_private',1)->where('client_id',Auth()->user()->main_user_id)->get();

        //Here we join the comment table with the pivot table to be able to get the post_id
        $postcomments = Comment::leftJoin('comment_posts', function($join) {
            $join->on('comments.id', '=', 'comment_posts.comment_id');
          })->get();
        $companies = Company::get();
        
        /*
        if(!is_null($MU_id)){
          $clients = Client::leftJoin('client_main_users', function($join) {
            $join->on('clients.id', '=', 'client_main_users.client_id');
          })->where('main_user_id',Auth()->user()->main_user_id)->get();
        }
        else{
          $clients = null;
        }
        */
        //these are the diffrent test to see what's in there
        //dd(Auth()->user()->main_user_id);
        //dd($posts);
        //dd($postcomments);
        //dd($clients);
        //dd($companies);
        //this returns the needed values to the view
        return view('mainuserview',['posts' => $posts, 'comments' => $postcomments, 'companies' => $companies, 'user' => $mainUserInfo, 'clients' => $clients]);
    }
   
    //SINGLE CLIENT STUFF
    public function getDiaries($id, $MU_id, $mainUserInfo, $clients){
      //get the id of the main user
      //$MU_id = Auth()->user()->main_user_id;
      
      //GET CLIENT INFO WITH LINKED COMPANY
      //$mainUserInfo = MainUser::with('companies')->distinct()->where('id', $MU_id)->get();
      //dd($mainUserInfo);
      //check if the user has been assigned to a main user
      /*
      if(!is_null($MU_id)){
        $clients = Client::leftJoin('client_main_users', function($join) {
          $join->on('clients.id', '=', 'client_main_users.client_id');
        })->where('main_user_id',$MU_id)->get();
      }
      else{
        $clients = null;
      }
      */
      //dd($clients);
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
          return view('mainuserviewdiary',['Diaries' => $diary, 'Company' =>$company, 'Clients' => $clients, 'curClient' => $curClient, 'User' => $mainUserInfo]);
        }
      }
      return redirect()->route('mainuserview');
      //dd($company);
      
    }

    public function getMainUserInfo($mainUserInfo, $MU_id, $clients){
      //$MU_id = Auth()->user()->main_user_id;
      
      $Userdata = MainUser::where('id',$MU_id)->get();

      //$mainUserInfo = MainUser::with('companies')->distinct()->where('id', $MU_id)->get();
      
      /*
      if(!is_null($MU_id)){
        $clients = Client::leftJoin('client_main_users', function($join) {
          $join->on('clients.id', '=', 'client_main_users.client_id');
        })->where('main_user_id',Auth()->user()->main_user_id)->get();
      }
      else{
        $clients = null;
      }
      */
      //dd($Userdata);
      return view('mainuserSettings',['Userdata' => $Userdata,'user' => $mainUserInfo,'clients' => $clients]);
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
      //dd($id);
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
      $mainUserInfo = MainUser::with('companies')->distinct()->where('id', $MU_id)->get();

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
        return $this->getDiaries($id[1], $MU_id, $mainUserInfo, $clients);
      }
      elseif(Str::contains($location,'usersettings')){
        return $this->getMainUserInfo($mainUserInfo, $MU_id, $clients);
      }
      else{
        return $this->getPost($mainUserInfo, $MU_id, $clients);
      }
      return view('mainuserview');
    }
}
