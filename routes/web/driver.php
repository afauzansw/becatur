<?php

use App\Http\Controllers\Web\DriverWebController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'backoffice/driver', 'as' => 'backoffice.driver.', 'middleware' => 'auth.admin'],
    function () {
        Route::get('', [DriverWebController::class, 'index'])->name('index');
        Route::get('fetch', [DriverWebController::class, 'fetch'])->name('fetch');
        Route::get('{id}', [DriverWebController::class, 'show'])->name('show');
    }
);
