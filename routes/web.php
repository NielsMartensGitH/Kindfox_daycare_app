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
});

Route::middleware(['auth', 'auth.company'])->group(function() {
    Route::get('/dashboard',[DashBoardController::class, 'index'])->name('dashboard');
});



// FOR TESTING PURPOSES IN TESTVIEW ONLY
Route::get('/image', function() {
    $image = Media::all()->first()->media_path;
    return view('testview.index', compact('image'));
});


require __DIR__.'/auth.php';


// Route::get('/dashboard', function() {
//     return view('dashboard');
// })->name('dashboard');