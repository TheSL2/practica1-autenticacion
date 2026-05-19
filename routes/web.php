<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostAdminController;
use App\Http\Controllers\Admin\AuditController;

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/posts', PostAdminController::class);
    Route::resource('/audits', AuditController::class)->only(['index', 'show']);
});
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