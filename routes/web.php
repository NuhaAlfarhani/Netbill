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

    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers')->middleware('can:customers.view');
    Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('customers.show')->middleware('can:customers.view');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store')->middleware('can:customers.store');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update')->middleware('can:customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy')->middleware('can:customers.delete');

    // Packages
    Route::get('/packages', [PackageController::class, 'index'])->name('packages')->middleware('can:packages.view');

    // Bills
    Route::get('/bills', [BillController::class, 'index'])->name('bills')->middleware('can:bills.view');
    Route::post('/bills/generate', [BillController::class, 'generate'])->name('bills.generate')->middleware('can:bills.generate');
    Route::put('/bills/{bill}/pay', [BillController::class, 'pay'])->name('bills.pay')->middleware('can:bills.pay');
    Route::get('/bills/{bill}', [BillController::class, 'print'])->name('bills.print')->middleware('can:bills.print');
    Route::delete('/bills/{bill}', [BillController::class, 'destroy'])->name('bills.destroy')->middleware('can:bills.delete');

    // Mikrotik
    Route::get('/mikrotik', [MikrotikController::class, 'index'])->name('mikrotik');

    // Logs
    Route::get('/logs', [LogController::class, 'index'])->name('logs');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings');

    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports');

    // Roles & Users
    Route::get('/roles', [RoleController::class, 'index'])->name('roles');

    // Users
    Route::get('/users', [UserController::class, 'index'])->name('users');
});
