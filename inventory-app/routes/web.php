<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CashBookController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SheetController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes (Require Authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/', function() {
        return redirect()->route('sheets.index');
    })->name('dashboard');

    Route::resource('items', ItemController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('customers', CustomerController::class);
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');

    Route::resource('purchases', PurchaseController::class);
    Route::resource('sales', SaleController::class);
    Route::resource('cashbook', CashBookController::class);

    // Sheet Routes - single page with prev/next navigation
    Route::get('/sheets', [SheetController::class, 'index'])->name('sheets.index');
    Route::post('/sheets', [SheetController::class, 'store'])->name('sheets.store');
    Route::delete('/sheets/row', [SheetController::class, 'deleteRow'])->name('sheets.deleteRow');
    Route::get('/sheets/create', [SheetController::class, 'create'])->name('sheets.create');
    Route::get('/sheets/list', [SheetController::class, 'list'])->name('sheets.list');

    // Admin Only Routes
    Route::middleware(['admin'])->group(function () {
        Route::resource('users', UserController::class);
        Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    });
});
