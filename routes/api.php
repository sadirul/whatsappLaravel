<?php

use App\Http\Controllers\WhatsappApiController;
use App\Http\Middleware\CheckInstanceKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware(CheckInstanceKey::class)->group(function () {
    Route::get('/whatsapp/start-session', [WhatsappApiController::class, 'startSession'])->name('whatsapp.start');
    Route::get('/whatsapp/get-qr', [WhatsappApiController::class, 'getQr'])->name('whatsapp.qr');
    Route::post('/whatsapp/send-message', [WhatsappApiController::class, 'sendMessage'])->name('whatsapp.send');
    Route::post('/whatsapp/send-file', [WhatsappApiController::class, 'sendFile'])->name('whatsapp.sendFile');
    Route::get('/whatsapp/logout', [WhatsappApiController::class, 'logout'])->name('whatsapp.logout');
});
