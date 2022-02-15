<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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
/* 
|-------------
| application language
|-------------
*/
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
/* 
|-------------
| guest and log out
|-------------
*/
require __DIR__.'/auth.php';

/* 
|-------------
| Only admin
|-------------
*/
Route::middleware(['administrator','auth'])->group(function () {

});
/* 
|-------------
| Only login  
|-------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/',          [PostController::class, 'index'])->name('home');               // all post
    Route::get('/user/{email}', [UserController::class, 'show'])->name('user.post');        // post by user email
    Route::get('/user/edit/{email}', [UserController::class, 'edit'])->name('user.edit');   // Edit user profile
    Route::get('/tag/{tag}',  [TagController::class, 'show']);                              // post by tag
    Route::get('{slug}',     [PostController::class, 'show'])->name('post.show');           // post by slug
    Route::put('{slug}',     [PostController::class, 'update'])->name('post.update');       // post update by slug
    Route::get('/edit/{slug}',[PostController::class, 'edit'])->name('post.edit');          // post edit by slug
    Route::get('/delete/{slug}',[PostController::class, 'delete'])->name('post.delete');    // post delete by slug


    // post resource
    Route::resource('/post', PostController::class )->except(['index', 'show', 'edit', 'update']);
    // comment resource
    Route::resource('comment', CommentController::class )->only(['show', 'store']);
    // user resource
    Route::resource('/user', UserController::class )->only(['update']);
    
});
/* 
|-------------
| Only my posts  
|-------------
*/
Route::middleware(['auth', 'MyProfile'])->group(function () {
    Route::get('my-posts/{email}', [UserController::class, 'showMyProfile'])->name('my.posts'); // my post by user email   
});