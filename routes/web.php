<?php

use App\Livewire\ProductManager;
use App\Livewire\TransactionForm;
use App\Livewire\CategoryComponent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('products', ProductManager::class)
    ->middleware(['auth'])
    ->name('products');

Route::get('categories', CategoryComponent::class)
    ->middleware(['auth'])
    ->name('categories');

Route::get('/transactions', TransactionForm::class)
    ->middleware(['auth'])
    ->name('transactions');



Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
