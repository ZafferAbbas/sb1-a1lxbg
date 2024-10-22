<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Services routes
    Route::resource('services', ServiceController::class);
    
    // Booking routes
    Route::resource('bookings', BookingController::class);
    Route::get('services/{service}/book', [BookingController::class, 'create'])
        ->name('services.book');
    
    // Professional-only routes
    Route::middleware(['role:professional'])->group(function () {
        Route::get('dashboard/services', [ServiceController::class, 'professional'])
            ->name('professional.services');
        Route::get('dashboard/bookings', [BookingController::class, 'professional'])
            ->name('professional.bookings');
    });
    
    // Admin-only routes
    Route::middleware(['role:admin'])->group(function () {
        Route::get('admin/services', [ServiceController::class, 'admin'])
            ->name('admin.services');
        Route::get('admin/bookings', [BookingController::class, 'admin'])
            ->name('admin.bookings');
    });
});