<?php

use App\Http\Controllers\Admin\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route(auth()->check() ? 'admin.dashboard' : 'login'));

Route::prefix('admin')->middleware(['auth', 'can:admin'])->group(function () {
    Route::get('dashboard', fn () => view('admin.dashboard'))->name('admin.dashboard');

    Route::get('customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('customers/create', [CustomerController::class, 'create'])->name('admin.customers.create');
    Route::post('customers', [CustomerController::class, 'store'])->name('admin.customers.store');
});

Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))
    ->middleware(['auth', 'can:admin'])->name('dashboard');

require __DIR__.'/auth.php';
