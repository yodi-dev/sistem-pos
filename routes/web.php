<?php

use App\Livewire\ProductManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('products', ProductManager::class)
    ->middleware(['auth'])
    ->name('products.index');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
