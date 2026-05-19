<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\Admin\AuditController;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard-roles', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:admin,editor'])->name('dashboard.roles');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified', 'role:admin,editor'])->prefix('admin')->name('admin.')->group(function () {    

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('role:admin')
        ->name('dashboard');

    Route::resource('/posts', PostAdminController::class);

    Route::resource('/audits', AuditController::class)
        ->only(['index', 'show'])
        ->middleware('role:admin');
});

require __DIR__.'/auth.php';