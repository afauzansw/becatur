<?php

use App\Http\Controllers\Web\SettingWebController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'backoffice/setting', 'as' => 'backoffice.setting.', 'middleware' => 'auth.admin'],
    function () {
        Route::get('', [SettingWebController::class, 'index'])->name('index');
        Route::put('', [SettingWebController::class, 'update'])->name('update');
    }
);
