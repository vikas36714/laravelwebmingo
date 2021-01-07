<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\VendorLoginController;
use App\Http\Controllers\Vendor\OrderController;
use App\Http\Controllers\Vendor\PendingOrderController;
use App\Http\Controllers\Vendor\ManageOrderStatusController;
use App\Http\Controllers\Vendor\WalletController;
use App\Http\Controllers\Vendor\LoanHistoryController;

# VENDOR ROUTES #

//-------------------- VENDOR LOGIN ------------------------//
Route::get('vendor/login', [VendorLoginController::class, 'index'])->name('vendor.login');
Route::post('vendor/login', [VendorLoginController::class, 'Login']);

Route::group(['prefix' => 'vendor/dashboard','middleware' => ['auth', 'vendor']], function () {

    //-------------------- VENDOR DASHBOARD ------------------------//
    Route::get('/', function () {
        return view('vendor/dashboard');
    })->name('vendor.dashboard');

    //-------------------- MANAGE ORDER ------------------------//
    Route::get('order', [OrderController::class, 'index'])->name('vendor.order');
    Route::get('order/get-package-details', [OrderController::class, 'getPackageDetails'])->name('vendor.manage-order.get-package-details');
    Route::get('manage-order-status/{id}', [ManageOrderStatusController::class, 'index'])->name('vendor.manage-order-status');

    Route::post('manage-order-status', [ManageOrderStatusController::class, 'store'])->name('vendor.manage-order-status.store');

    Route::get('pending-order', [PendingOrderController::class, 'index'])->name('vendor.pending-order');

    //-------------------- MANAGE LOAN ------------------------//
    Route::get('wallet', [WalletController::class, 'index'])->name('vendor.wallet');
    Route::get('loan-history', [LoanHistoryController::class, 'index'])->name('vendor.loan-history');
    // Route::get('logout', [OrderController::class, 'logout'])->name('logout');

});
