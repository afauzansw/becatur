<?php

use App\Http\Controllers\Api\User\ReservationUserController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'user/reservation', 'as' => 'user.reservation.'],
    function () {
        Route::get('', [ReservationUserController::class, 'index'])->name('index');
        Route::get('{id}', [ReservationUserController::class, 'show'])->name('show');
        Route::post('', [ReservationUserController::class, 'store'])->name('store');
        Route::put('{id}/cancel', [ReservationUserController::class, 'cancel'])->name('cancel');
        Route::put('{id}/payment', [ReservationUserController::class, 'payment'])->name('payment');
    }
);
