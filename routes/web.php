<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\CommentController;

// Main landing page route
Route::get('/', function () {
    return view('welcome'); // Render the custom welcome page with login/signup
});

// Dashboard route
Route::get('/dashboard', function () {
    return view('dashboard'); // Only accessible to authenticated users
})->middleware(['auth', 'verified'])->name('dashboard');

// Blog Post resource routes with authentication middleware
Route::resource('blog-posts', BlogPostController::class)->middleware('auth');

// Route for storing comments
Route::post('blog-posts/{blogPost}/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');

// Profile management routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Load authentication routes
require __DIR__.'/auth.php';
