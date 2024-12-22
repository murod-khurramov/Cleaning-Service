<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('posts', function () {
    $posts = Cache::remember('posts', 30, function () {
        return Post::latest()->get();
    });

    return $posts;
});
