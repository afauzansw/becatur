<?php

use App\Http\Controllers\Api\User\ProfileUserController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'user/profile', 'as' => 'user.profile.'],
    function () {
        Route::get('', [ProfileUserController::class, 'index'])->name('index');
        Route::post('', [ProfileUserController::class, 'update'])->name('update');
    }
);
