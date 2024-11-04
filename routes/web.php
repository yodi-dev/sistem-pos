<?php

use App\Livewire\ProductManager;
use App\Livewire\CategoryManager;
use App\Livewire\CustomerManager;
use App\Livewire\TransactionManager;
use App\Livewire\UnitManagement;
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

Route::get('customers', CustomerManager::class)
    ->middleware(['auth'])
    ->name('customers');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
