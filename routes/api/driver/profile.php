<?php

use App\Http\Controllers\Api\Driver\ProfileDriverController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'driver/profile', 'as' => 'driver.profile.'],
    function () {
        Route::get('', [ProfileDriverController::class, 'index'])->name('index');
        Route::post('', [ProfileDriverController::class, 'update'])->name('update');
    }
);
