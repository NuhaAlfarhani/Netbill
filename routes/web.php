<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\MikrotikController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// protected
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/customers', [CustomerController::class, 'index'])->name('customers')->middleware('can:customers.view');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store')->middleware('can:customers.store');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update')->middleware('can:customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy')->middleware('can:customers.delete');

    Route::get('/packages', [PackageController::class, 'index'])->name('packages');

    Route::get('/billing', [BillController::class, 'index'])->name('billing');

    Route::get('/mikrotik', [MikrotikController::class, 'index'])->name('mikrotik');

    Route::get('/logs', [LogController::class, 'index'])->name('logs');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles');

    Route::get('/users', [UserController::class, 'index'])->name('users');
});
