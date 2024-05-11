<?php

use App\Http\Controllers\PostsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
Route::get('/', function () {
    return view('welcome');
});
Route:: resource('comments', CommentController::class);
Route:: resource('users', UserController::class);
Route::get('/posts',[PostsController::class,'index'])->name('posts.index');
Route::get('/posts/create',[PostsController::class,'create'])->name('posts.create');
Route::get('/posts/{id}',[PostsController::class,'show'])->name('posts.show');
Route::get('/posts/{id}/edit',[PostsController::class,'edit'])->name('posts.edit');
Route::put('/posts/{id}',[PostsController::class,'update'])->name('posts.update');
Route::post('/posts/store',[PostsController::class,'store'])->name('posts.store');
Route::delete('/posts/{id}',[PostsController::class,'destroy'])->name('posts.destroy');
Route::get('restoreAll', [PostsController::class, 'restoreAll'])->name('posts.restore_all');
Route::get('posts/{id}/users', [PostsController::class,'showUsers'])->name('posts.users');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
