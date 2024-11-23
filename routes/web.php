<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'main']);
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/project', [PageController::class, 'project'])->name('project');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::resource('posts', PostController::class);


//Route::get('posts', [PageController::class, 'index'])->name('posts.index');
//Route::get('posts/{post}', [PageController::class, 'show'])->name('posts.show');
//Route::get('posts/create', [PageController::class, 'create'])->name('posts.create');
//Route::post('posts/create', [PageController::class, 'store'])->name('posts.store');
//Route::get('posts/{post}/edit', [PageController::class, 'edit'])->name('posts.edit');
//Route::put('posts/{post}/edit', [PageController::class, 'update'])->name('posts.update');
//Route::delete('posts/{post}/delete', [PageController::class, 'delete'])->name('posts.delete');

