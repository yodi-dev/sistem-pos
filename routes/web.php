<?php

use App\Livewire\ProductManager;
use App\Livewire\CategoryManager;
use App\Livewire\TransactionManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('products', ProductManager::class)
    ->middleware(['auth'])
    ->name('products');

Route::get('categories', CategoryManager::class)
    ->middleware(['auth'])
    ->name('categories');

Route::get('transactions', TransactionManager::class)
    ->middleware(['auth'])
    ->name('transactions');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
