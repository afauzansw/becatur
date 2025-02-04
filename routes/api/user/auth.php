<?php

use App\Http\Controllers\Api\User\AuthUserController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'user/auth', 'as' => 'user.auth.'],
    function () {
        Route::post('login', [AuthUserController::class, 'attempt'])->name('login');
        Route::post('register', [AuthUserController::class, 'store'])->name('register');
        Route::post('logout', [AuthUserController::class, 'logout'])->name('logout');
        Route::post('refresh', [AuthUserController::class, 'refreshToken'])->name('refresh');
    }
);
