<?php

use App\Http\Controllers\Api\Auth\AuthApiController;
use App\Http\Controllers\Web\AuthWebController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'auth', 'as' => 'auth.'],
    function () {
        Route::get('login', [AuthWebController::class, 'login'])->name('login');
        Route::post('attempt', [AuthWebController::class, 'attempt'])->name('attempt');
        Route::post('logout', [AuthWebController::class, 'logout'])->name('logout');
    }
);
