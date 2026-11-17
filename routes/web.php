<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\WorkshopController;
use App\Http\Middleware\EnsurePanitia;
use Illuminate\Support\Facades\Route;

// 1. Public Routes (Katalog Workshop)
Route::get('/', [WorkshopController::class, 'index'])->name('workshops.index');
Route::get('/workshop/{workshop:slug}', [WorkshopController::class, 'show'])->name('workshops.show');

// 2. Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// 3. Peserta Routes (Pendaftaran, Pembayaran Midtrans, Tiket Digital)
Route::middleware('auth')->group(function () {
    Route::post('/workshop/{workshop}/register', [RegistrationController::class, 'store'])->name('registrations.store');
    Route::get('/registration/{registration}/pay', [RegistrationController::class, 'pay'])->name('registrations.pay');
    Route::post('/registration/{registration}/simulate-pay', [RegistrationController::class, 'simulateSuccess'])->name('registrations.simulate-pay');
    Route::get('/ticket/{registration}', [RegistrationController::class, 'show'])->name('registrations.show');
    Route::get('/my-tickets', [RegistrationController::class, 'myTickets'])->name('registrations.my-tickets');
});

// 4. Panitia Dashboard & Management (Protected by EnsurePanitia Middleware)
Route::middleware(['auth', EnsurePanitia::class])->prefix('admin')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/workshops', [DashboardController::class, 'workshops'])->name('workshops');
    Route::get('/workshops/create', [DashboardController::class, 'createWorkshop'])->name('workshops.create');
    Route::post('/workshops', [DashboardController::class, 'storeWorkshop'])->name('workshops.store');
    Route::get('/workshops/{workshop}/edit', [DashboardController::class, 'editWorkshop'])->name('workshops.edit');
    Route::put('/workshops/{workshop}', [DashboardController::class, 'updateWorkshop'])->name('workshops.update');
    Route::delete('/workshops/{workshop}', [DashboardController::class, 'destroyWorkshop'])->name('workshops.destroy');

    // Uji & Perbandingan N+1 Query (LKPD Checkpoint 05)
    Route::get('/participants', [DashboardController::class, 'participants'])->name('participants');
});
