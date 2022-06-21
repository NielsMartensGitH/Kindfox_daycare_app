<?php

use Illuminate\Support\Facades\Route;

use App\Models\Client;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Diary;
use App\Models\Event;
use App\Models\MainUser;
use App\Models\Post;
use App\Models\Media;
use App\Models\User;
use App\Models\Notification;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\mainUserController;
use App\Http\Controllers\DashBoardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// MAIN LOGIN PAGE WHICH YOU WILL REDIRECT TO  IF YOU ARE NOT LOGGED IN
Route::get('/', function() {
    return view('auth.login');
});

// MAINUSER ROUTE GROUP WHICH IS ONLY ACCESSIBLE WHEN LOGGED IN AS MAIN_USER ROLE
Route::middleware(['auth', 'auth.user'])->group(function() {
    // SHOW MESSAGEBOARD
    Route::get('/messageboard',[mainUserController::class,'mainPageNeeded'])->name('mainuserview');
    // SHOW INDIVIDUAL DIARIES PER CHILD
    Route::get('/diaries/{id}',[mainUserController::class,'mainPageNeeded'])->name('mainuserviewclients');
     // SHOW FORM WHERE YOU CAN EDIT USER DETAILS
    Route::get('/usersettings',[mainUserController::class,'mainPageNeeded'])->name('usersettings');
    // ROUTE ONLY FOR TESTING PURPOSES
    Route::get('/testredundance',[mainUserController::class,'mainPageNeeded'])->name('roeltest');
    // ROUTE WHICH WILL MARK EVERY UNREAD NOTIFICATION AS READ
    Route::get('/notifications', [mainUserController::class, 'mark_notifications_as_read'])->name('notifications.read');
     // ROUTE TO GET DE DETAIL OF AN INDIVIDUAL DIARY
     Route::get('/diary/{id}/', [mainUserController::class, 'diary_individual_detail'])->name('client_diary.detail');
    // ROUTE TO POST NEW COMMENT WITH AJAX
    Route::post('/mainusercomment', [mainUserController::class, 'store_comment'])->name('clientcomment.store');
    // ROUTE WHICH WILL UPDATE USER DETAILS
    Route::put('/updateuser/{id}',[mainUserController::class,'updateMainUser'])->name('updateuser');
});

// DASHBOARD ROUTE GROUP WHICH IS ONLY ACCESSIBLE WHEN LOGGED IN AS COMPANY ROLE
Route::middleware(['auth', 'auth.company'])->group(function() {
    // SHOW DASBOARD PAGE
    Route::get('/dashboard',[DashBoardController::class, 'index'])->name('dashboard');
    // SHOW PARENTS PAGE
    Route::get('/parents',[DashBoardController::class, 'show_parents'])->name('parents');
    // SHOW POSTS PAGE
    Route::get('/posts',[DashBoardController::class, 'show_posts'])->name('posts');
    // SHOW DIARIES PAGE
    Route::get('/diaries',[DashBoardController::class, 'show_diaries'])->name('diaries');
    // ROUTE WHICH WILL DELETE A POST
    Route::get('/posts/{post}', [DashBoardController::class, 'destroy_post'])->name('post.destroy');
    // ROUTE WHICH WILL DELETE A DIARY
    Route::get('/delete_diary/{diary}', [DashBoardController::class, 'destroy_diary'])->name('diary.destroy');
    // SHOW DETAILS OF INDIVIDUAL PARENT
    Route::get('/parent/{parent}', [DashBoardController::class, 'parent_detail'])->name('parent.detail');
    // SHOW ALL DIARIES
    Route::get('/diary/{diary}', [DashBoardController::class, 'diary_detail'])->name('diary.detail');
    // ROUTE WHICH WILL DELETE A COMMENT
    Route::get('/comment/{comment}', [DashBoardController::class, 'destroy_comment'])->name('comment.destroy');
    // ROUTE WHICH WILL MARK EVERY UNREAD NOTIFICATION AS READ
    Route::get('/companynotifications', [DashBoardController::class, 'mark_notifications_as_read'])->name('companynotifications.read');
    // ROUTE WHICH WILL DELETE A CLIENT FROM THE DETAILPAGE OF ONE PARENT
    Route::get('/child/{client}/{user?}', [DashBoardController::class, 'destroy_client'])->name('client.destroy');
    // ROUTE WHICH STORES A NEW DIARY
    Route::post('/diary', [DashBoardController::class, 'store_diary'])->name('diary.store');
    // ROUTE WHICH STORES A NEW CHILD
    Route::post('/child', [DashBoardController::class, 'store_child'])->name('child.store');
    // ROUTE WHICH STORES A NEW COMMENT
    Route::post('/comment', [DashBoardController::class, 'store_comment'])->name('comment.store');
    // ROUTE WHICH STORES A NEW PARENT
    Route::post('/parent', [DashBoardController::class, 'store_parent'])->name('parent.store');
    // ROUTE WHICH STORES A NEW POST
    Route::post('/posts', [DashBoardController::class, 'store_post'])->name('post.store');
    // ROUTE FOR EDITING AN EXISTING POST
    Route::put('/post/{post}', [DashBoardController::class, 'edit_post'])->name('post.edit');
    // ROUTE FOR CHECKING IN A CHILD
    Route::put('/dashboard/client/{client}', [DashBoardController::class, 'update_child_status'])->name('child.update');
    // ROUTE FOR EDITING CHILD DETAILS
    Route::put('/client/{client}', [DashBoardController::class, 'edit_client'])->name('client.edit');
});


require __DIR__.'/auth.php';
