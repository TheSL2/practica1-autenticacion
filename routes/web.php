Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('role:admin,editor')->name('dashboard');
    
    Route::post('/posts', [PostController::class, 'store'])->middleware('role:editor');
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->middleware('role:admin');
});