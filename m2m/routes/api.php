<?php

use App\Http\Controllers\{PostController, TagController, PostTagController, AuthController};
use App\Http\Requests\LoginUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');

Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
Route::post('/posts/{post}/tags/{tag}', [PostTagController::class, 'attach'])->name('post.tags.attach');
Route::delete('/posts/{post}/tags/{tag}', [PostTagController::class, 'detach'])->name('posts.tags.detach');

Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:10,1');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:10,1');

//required to be loged in with session token
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/user', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});