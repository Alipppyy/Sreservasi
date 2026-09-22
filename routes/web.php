<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TechnicianController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes (No Login)
Route::get('/', function () {
    return view('public.landing');
});

Route::get('/booking', [BookingController::class, 'showForm'])->name('booking.form');
Route::post('/booking', [BookingController::class, 'submit'])->name('booking.submit');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(\App\Http\Middleware\Authenticate::class)->group(function () {
    
    // Admin Routes
    Route::middleware('can:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::post('/booking/{id}/assign', [AdminController::class, 'assign'])->name('booking.assign');
    });

    // Technician Routes
    Route::middleware('can:teknisi')->prefix('teknisi')->name('teknisi.')->group(function () {
        Route::get('/dashboard', [TechnicianController::class, 'index'])->name('dashboard');
        Route::post('/booking/{id}/complete', [TechnicianController::class, 'complete'])->name('booking.complete');
    });
});
