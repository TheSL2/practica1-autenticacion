<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    

    Route::get('/dashboard-roles', function () {
        return view('dashboard');
    })->middleware('role:admin,editor')->name('dashboard.roles');
    

    Route::post('/posts', [PostController::class, 'store'])->middleware('role:editor');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('role:admin');
});

require __DIR__.'/auth.php';