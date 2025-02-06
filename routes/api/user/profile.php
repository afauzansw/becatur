<?php

use App\Http\Controllers\Api\User\ProfileUserController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'user/profile', 'as' => 'user.profile.', 'middleware' => 'auth.user'],
    function () {
        Route::get('', [ProfileUserController::class, 'index'])->name('index');
        Route::put('', [ProfileUserController::class, 'update'])->name('update');
    }
);
