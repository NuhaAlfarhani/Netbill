<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\PackagesController;
use App\Http\Controllers\BillingController;
use App\Http\Controllers\MikrotikController;
use App\Http\Controllers\LogsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersController;

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

    Route::get('/customers', [CustomersController::class, 'index'])->name('customers');
    Route::get('/customers/create', [CustomersController::class, 'create'])->name('customers.create');
    Route::post('/customers/create', [CustomersController::class, 'create'])->name('customers.store');

    Route::get('/packages', [PackagesController::class, 'index'])->name('packages');

    Route::get('/billing', [BillingController::class, 'index'])->name('billing');

    Route::get('/mikrotik', [MikrotikController::class, 'index'])->name('mikrotik');

    Route::get('/logs', [LogsController::class, 'index'])->name('logs');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');

    Route::get('/reports', [ReportsController::class, 'index'])->name('reports');

    Route::get('/roles', [RolesController::class, 'index'])->name('roles');

    Route::get('/users', [UsersController::class, 'index'])->name('users');
});
