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


Route::get('/', function() {
    return view('auth.login');
});

Route::middleware(['auth', 'auth.user'])->group(function() {
    Route::get('/messageboard',[mainUserController::class,'mainPageNeeded'])->name('mainuserview');
    Route::get('/diaries/{id}',[mainUserController::class,'mainPageNeeded'])->name('mainuserviewclients');
    Route::get('/usersettings',[mainUserController::class,'mainPageNeeded'])->name('usersettings');
    Route::put('/updateuser/{id}',[mainUserController::class,'updateMainUser'])->name('updateuser');
    Route::get('/testredundance',[mainUserController::class,'mainPageNeeded'])->name('roeltest');
    Route::get('/notifications', [mainUserController::class, 'mark_notifications_as_read'])->name('notifications.read');
    Route::post('/mainusercomment', [mainUserController::class, 'store_comment'])->name('clientcomment.store');
});

Route::middleware(['auth', 'auth.company'])->group(function() {
    Route::get('/dashboard',[DashBoardController::class, 'index'])->name('dashboard');
    Route::get('/parents',[DashBoardController::class, 'show_parents'])->name('parents');
    Route::get('/posts',[DashBoardController::class, 'show_posts'])->name('posts');
    Route::get('/diaries',[DashBoardController::class, 'show_diaries'])->name('diaries');
    Route::post('/posts', [DashBoardController::class, 'store_post'])->name('post.store');
    Route::put('/post/{post}', [DashBoardController::class, 'edit_post'])->name('post.edit');
    Route::get('/posts/{post}', [DashBoardController::class, 'destroy_post'])->name('post.destroy');
    Route::get('/delete_diary/{diary}', [DashBoardController::class, 'destroy_diary'])->name('diary.destroy');
    Route::post('/comment', [DashBoardController::class, 'store_comment'])->name('comment.store');
    Route::post('/parent', [DashBoardController::class, 'store_parent'])->name('parent.store');
    Route::get('/parent/{parent}', [DashBoardController::class, 'parent_detail'])->name('parent.detail');
    Route::get('/diary/{diary}', [DashBoardController::class, 'diary_detail'])->name('diary.detail');
    Route::post('/diary', [DashBoardController::class, 'store_diary'])->name('diary.store');
    Route::post('/child', [DashBoardController::class, 'store_child'])->name('child.store');
    Route::put('/client/{client}', [DashBoardController::class, 'edit_client'])->name('client.edit');
    Route::get('/child/{client}/{user?}', [DashBoardController::class, 'destroy_client'])->name('client.destroy');
    Route::get('/comment/{comment}', [DashBoardController::class, 'destroy_comment'])->name('comment.destroy');
    // Route::get('/comment/{comment_id}', [DashBoardController::class, 'add_comment'])->name('comment.show');
});



// FOR TESTING PURPOSES IN TESTVIEW ONLY
Route::get('/image', function() {
    $image = Media::all()->first()->media_path;
    return view('testview.index', compact('image'));
});

// Route::get('test', function () {
//     event(new App\Events\NewComment('Someone'));
//     return "Event has been sent!";
// });

Route::get('welcome', function() {
    return view('welcome');
});

require __DIR__.'/auth.php';

// FOR TESTING PURPOSES ONLY
// Route::get('/dashboard', function() {
//     return view('dashboard');
// })->name('dashboard');