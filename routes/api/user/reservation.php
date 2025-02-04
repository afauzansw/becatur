<?php

use App\Http\Controllers\Api\User\ReservationUserController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'user/reservation', 'as' => 'user.reservation.'],
    function () {
        Route::get('', [ReservationUserController::class, 'index'])->name('index');
        Route::post('', [ReservationUserController::class, 'store'])->name('store');
        Route::get('{id}', [ReservationUserController::class, 'show'])->name('show');
        Route::put('{id}/cancel', [ReservationUserController::class, 'cancel'])->name('cancel');
        Route::put('{id}/payment', [ReservationUserController::class, 'payment'])->name('payment');
    }
);
