<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function(){
    echo 'This is Home Page';
})->name('home');

Route::middleware('auth', 'isAdmin')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::resource('users', UserController::class)->names('users');
    Route::resource('profiles', UserProfileController::class)->names('profiles');
    Route::resource('posts', PostController::class)->names('posts');
    Route::resource('comments', CommentController::class)->names('comments');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'isUser')->group(function () {
    // Route::view('user/home', 'user.home')->name('user.home');

    // Route::get('/user/profile', [UserProfileController::class, 'edit'])->name('user.pages.profile.edit');
    // Route::patch('/user/profile', [UserProfileController::class, 'update'])->name('user.pages.profile.update');
    // Route::delete('/user/profile', [UserProfileController::class, 'destroy'])->name('user.pages.profile.destroy');
});

require __DIR__.'/auth.php';
