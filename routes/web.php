<?php

use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SignUpController;
use App\Http\Controllers\DocController;
use App\Http\Controllers\WhatsappApiController;
use App\Http\Controllers\WhatsAppInstanceController;
use Illuminate\Support\Facades\Route;

// Public welcome page
Route::get('/', function () {
    return view('welcome');
});

// 🟢 Guest-only routes (only accessible when NOT logged in)
Route::middleware('guest')->group(function () {
    Route::get('/signup', [SignUpController::class, 'index'])->name('signup');
    Route::post('/auth/store', [SignUpController::class, 'store'])->name('auth.store');

    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login/verify', [LoginController::class, 'verify'])->name('login.verify');
});

// 🔐 Auth-only routes (only accessible when logged in)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Optional: Logout route
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    
    Route::get('/whatsapp', [WhatsAppInstanceController::class, 'index'])->name('whatsapp.instance.index');
    Route::post('/whatsapp-instance', [WhatsAppInstanceController::class, 'store'])->name('whatsapp.instance.store');
    Route::get('/whatsapp-instance/{id}', [WhatsAppInstanceController::class, 'show'])->name('whatsapp.instance.show');
});

Route::get('/doc', [DocController::class, 'index'])->name('doc');



