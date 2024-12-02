<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// Static pages
Route::get('/', [PageController::class, 'main'])->name('main');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/project', [PageController::class, 'project'])->name('project');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Authentication routes
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Posts routes with middleware
Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class)->except(['index', 'show']);
});

// Public post routes
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Other resource routes
Route::resources([
    'comments' => CommentController::class,
    'users' => UserController::class,
]);



//use App\Http\Controllers\AuthController;
//use App\Http\Controllers\CommentController;
//use App\Http\Controllers\PageController;
//use App\Http\Controllers\PostController;
//use Illuminate\Support\Facades\Route;
//
//Route::get('/', [PageController::class, 'main'])->name('main');
//Route::get('/about', [PageController::class, 'about'])->name('about');
//Route::get('/services', [PageController::class, 'services'])->name('services');
//Route::get('/project', [PageController::class, 'project'])->name('project');
//Route::get('/contact', [PageController::class, 'contact'])->name('contact');
//
//Route::get('login', [AuthController::class, 'login'])->name('login');
//Route::post('authenticate', [AuthController::class, 'authenticate'])->name('authenticate');
//Route::post('logout', [AuthController::class, 'logout'])->name('logout');
//
//Route::middleware(['auth'])->group(function () {
//    Route::resource('posts', PostController::class)->except(['index', 'show']);
//});
//
//Route::resources([
//    'posts' => PostController::class,
//    'comments' => CommentController::class,
//    'users' => UserController::class,
//]);

//Route::get('posts', [PageController::class, 'index'])->name('posts.index');
//Route::get('posts/{post}', [PageController::class, 'show'])->name('posts.show');
//Route::get('posts/create', [PageController::class, 'create'])->name('posts.create');
//Route::post('posts/create', [PageController::class, 'store'])->name('posts.store');
//Route::get('posts/{post}/edit', [PageController::class, 'edit'])->name('posts.edit');
//Route::put('posts/{post}/edit', [PageController::class, 'update'])->name('posts.update');
//Route::delete('posts/{post}/delete', [PageController::class, 'delete'])->name('posts.delete');

