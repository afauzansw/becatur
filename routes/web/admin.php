<?php

use App\Http\Controllers\Web\AdminWebController;
use App\Http\Controllers\Web\SettingWebController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'backoffice/admin', 'as' => 'backoffice.admin.', 'middleware' => 'auth.admin'],
    function () {
        Route::get('', [AdminWebController::class, 'index'])->name('index');
        Route::get('fetch', [AdminWebController::class, 'fetch'])->name('fetch');
        // Route::put('{id}', [AdminWebController::class, 'update'])->name('update');
    }
);
