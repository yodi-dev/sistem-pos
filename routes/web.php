<?php

use App\Livewire\Product\ProductManager;
use App\Livewire\Category\CategoryManager;
use App\Livewire\Customer\CustomerManager;
use App\Livewire\Debt\DebtTransactions;
use App\Livewire\Product\BarcodeManager;
use App\Livewire\Product\CreateProduct;
use App\Livewire\Product\UnitManager;
use App\Livewire\Product\UpdateStok;
use App\Livewire\Transaction\TransactionManager;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('products', ProductManager::class)->name('products');
    Route::get('products/update', UpdateStok::class)->name('update.products');
    Route::get('products/create', CreateProduct::class)->name('create.product');
    Route::get('products/edit/{id}', CreateProduct::class)->name('edit.product');
    Route::get('products/unit/{id}', UnitManager::class)->name('unit.product');
    Route::get('products/barcode/{id}', BarcodeManager::class)->name('barcode.product');
    Route::get('categories', CategoryManager::class)->name('categories');
    Route::get('transactions', TransactionManager::class)->name('transactions');
    Route::get('customers', CustomerManager::class)->name('customers');
    Route::get('debts', DebtTransactions::class)->name('debts');
});


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
