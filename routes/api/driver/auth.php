<?php

use App\Http\Controllers\Api\Driver\AuthDriverController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'driver/auth', 'as' => 'driver.auth.'],
    function () {
        Route::post('login', [AuthDriverController::class, 'attempt'])->name('login');
        Route::post('register', [AuthDriverController::class, 'store'])->name('register');
        Route::post('logout', [AuthDriverController::class, 'logout'])->name('logout')->middleware('auth.driver');
        Route::post('refresh', [AuthDriverController::class, 'refreshToken'])->name('refresh')->middleware('auth.driver');
    }
);
