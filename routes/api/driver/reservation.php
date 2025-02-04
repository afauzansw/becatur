<?php

use App\Http\Controllers\Api\Driver\ReservationDriverController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'driver/reservation', 'as' => 'driver.reservation.'],
    function () {
        Route::get('', [ReservationDriverController::class, 'index'])->name('index');
        Route::get('{id}', [ReservationDriverController::class, 'show'])->name('show');
        Route::put('{id}/accept', [ReservationDriverController::class, 'accept'])->name('accept');
        Route::put('{id}/cancel', [ReservationDriverController::class, 'cancel'])->name('cancel');
    }
);
