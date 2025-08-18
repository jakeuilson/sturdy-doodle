<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
// Import Controllers
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group routes
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::resource('posts', PostController::class);
    
    // For adding comments to posts
    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

    // Index route for posts
    Route::get('/', [PostController::class, 'index']);

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
