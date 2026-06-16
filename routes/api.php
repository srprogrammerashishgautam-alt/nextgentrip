<?php

use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Support\ApiResponse;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->name('api.v1.')->group(function (): void {
    Route::prefix('auth')->name('auth.')->group(function (): void {
        Route::post('register', [AuthController::class, 'register'])->name('register');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('otp/send', [AuthController::class, 'sendOtp'])->name('otp.send');
        Route::post('otp/verify', [AuthController::class, 'verifyOtp'])->name('otp.verify');
        Route::post('magic-link', [AuthController::class, 'sendMagicLink'])->name('magic-link.send');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
        Route::middleware('auth:sanctum')->get('me', [AuthController::class, 'me'])->name('me');
    });

    Route::middleware(['auth:sanctum', 'permission:admin.view'])
        ->get('admin/ping', fn () => ApiResponse::success(['pong' => true], 'Admin access granted'))
        ->name('admin.ping');
});
