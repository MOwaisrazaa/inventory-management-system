<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CashBookController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('items', ItemController::class);
Route::resource('vendors', VendorController::class);
Route::resource('customers', CustomerController::class);
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

Route::resource('purchases', PurchaseController::class);
Route::resource('sales', SaleController::class);
Route::resource('cashbook', CashBookController::class);
