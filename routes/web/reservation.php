<?php

use App\Http\Controllers\Web\ReservationWebController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'backoffice/reservation', 'as' => 'backoffice.reservation.'],
    function () {
        Route::get('', [ReservationWebController::class, 'index'])->name('index');
        Route::get('fetch', [ReservationWebController::class, 'fetch'])->name('fetch');
        Route::get('{id}', [ReservationWebController::class, 'show'])->name('show');
        Route::put('{id}/accept-payment', [ReservationWebController::class, 'acceptPayment'])->name('accept-payment');
    }
);
