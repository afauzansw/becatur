<?php

use App\Http\Controllers\Web\UserWebController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'backoffice/user', 'as' => 'backoffice.user.', 'middleware' => 'auth.admin'],
    function () {
        Route::get('', [UserWebController::class, 'index'])->name('index');
        Route::get('fetch', [UserWebController::class, 'fetch'])->name('fetch');
        Route::get('{id}', [UserWebController::class, 'show'])->name('show');
    }
);
