<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'home'])->name('home');
Route::get('/about-us', [PageController::class, 'about'])->name('about-us');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/categories/{category:slug}', [PostController::class, 'byCategory'])->name('categories.show');
