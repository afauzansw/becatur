<?php

use App\Http\Controllers\Api\Auth\AuthApiController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'user/auth', 'as' => 'user.auth.'],
    function () {
        Route::post('login', [AuthApiController::class, 'attempt'])->name('login');
        Route::post('register', [AuthApiController::class, 'store'])->name('register');
        Route::post('logout', [AuthApiController::class, 'logout'])->name('logout');
        Route::post('refresh', [AuthApiController::class, 'refreshToken'])->name('refresh');
    }
);
