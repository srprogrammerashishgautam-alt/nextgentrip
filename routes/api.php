<?php

use App\Http\Controllers\Api\V1\AcquisitionController;
use App\Http\Controllers\Api\V1\Auth\AuthController;
use App\Http\Controllers\Api\V1\HotelController;
use App\Http\Controllers\Api\V1\OperationsController;
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

    Route::apiResource(
        'hotels',
        HotelController::class
    );

    Route::prefix('acquisition')->name('acquisition.')->group(function (): void {
        Route::post('discover', [AcquisitionController::class, 'discover'])->name('discover');
        Route::post('import', [AcquisitionController::class, 'import'])->name('import');
        Route::get('leads', [AcquisitionController::class, 'leads'])->name('leads.index');
        Route::get('leads/{lead}', [AcquisitionController::class, 'show'])->name('leads.show');
        Route::post('leads/{lead}/score', [AcquisitionController::class, 'score'])->name('leads.score');
        Route::post('leads/{lead}/invite', [AcquisitionController::class, 'invite'])->name('leads.invite');
    });

    Route::prefix('operations')->name('operations.')->group(function (): void {
        Route::get('room-types', [OperationsController::class, 'roomTypes'])->name('room-types.index');
        Route::post('room-types', [OperationsController::class, 'storeRoomType'])->name('room-types.store');
        Route::get('rate-plans', [OperationsController::class, 'ratePlans'])->name('rate-plans.index');
        Route::post('rate-plans', [OperationsController::class, 'storeRatePlan'])->name('rate-plans.store');
        Route::post('inventory', [OperationsController::class, 'upsertInventory'])->name('inventory.upsert');
        Route::get('bookings', [OperationsController::class, 'bookings'])->name('bookings.index');
        Route::post('bookings', [OperationsController::class, 'createBooking'])->name('bookings.store');
    });
});
