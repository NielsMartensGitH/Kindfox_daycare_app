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
    Route::get('/messageboard',[mainUserController::class,'getPost'])->name('mainuserview');
    Route::get('/messageboard/{id}',[mainUserController::class,'getDiaries'])->name('mainuserviewclients');
});

Route::middleware(['auth', 'auth.company'])->group(function() {
    Route::get('/dashboard',[DashBoardController::class, 'index'])->name('dashboard');
    Route::get('/parents',[DashBoardController::class, 'show_parents'])->name('parents');
    Route::get('/calendar',[DashBoardController::class, 'show_calendar'])->name('calendar');
    Route::get('/posts',[DashBoardController::class, 'show_posts'])->name('posts');
    Route::get('/diaries',[DashBoardController::class, 'show_diaries'])->name('diaries');
    Route::post('/posts', [DashBoardController::class, 'store_post'])->name('post.store');
    Route::put('/post/{post}', [DashBoardController::class, 'edit_post'])->name('post.edit');
    Route::get('/posts/{post}', [DashBoardController::class, 'destroy_post'])->name('post.destroy');
    Route::post('/comment', [DashBoardController::class, 'store_comment'])->name('comment.store');
    // Route::get('/comment/{comment_id}', [DashBoardController::class, 'add_comment'])->name('comment.show');
});



// FOR TESTING PURPOSES IN TESTVIEW ONLY
Route::get('/image', function() {
    $image = Media::all()->first()->media_path;
    return view('testview.index', compact('image'));
});

Route::get('/test', function() {
    dd(Auth::user()->company->id);
});

require __DIR__.'/auth.php';

// FOR TESTING PURPOSES ONLY
// Route::get('/dashboard', function() {
//     return view('dashboard');
// })->name('dashboard');