<?php

use App\Http\Controllers\Api\Auth\AuthApiController;
use App\Http\Controllers\Web\BackofficeWebController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/backoffice');

Route::group(
    ['prefix' => 'backoffice', 'as' => 'backoffice.', 'middleware' => 'auth.admin'],
    function () {
        Route::get('', [BackofficeWebController::class, 'index'])->name('index');
    }
);
