<?php

use App\Livewire\BarcodePrint;
use App\Livewire\ProductManager;
use App\Livewire\CategoryManager;
use App\Livewire\CustomerManager;
use App\Livewire\DebtTransactions;
use App\Livewire\Product\CreateProduct;
use App\Livewire\Product\UpdateStok;
use App\Livewire\TransactionManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('products', ProductManager::class)->name('products');
    Route::get('products/update', UpdateStok::class)->name('update.products');
    Route::get('products/create', CreateProduct::class)->name('create.product');
    Route::get('categories', CategoryManager::class)->name('categories');
    Route::get('transactions', TransactionManager::class)->name('transactions');
    Route::get('customers', CustomerManager::class)->name('customers');
    Route::get('debts', DebtTransactions::class)->name('debts');
    Route::get('barcode-print', BarcodePrint::class)->name('barcode.print');
});


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
