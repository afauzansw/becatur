<?php

use App\Http\Controllers\Api\User\SettingUserController;
use Illuminate\Support\Facades\Route;

Route::group(
    ['prefix' => 'user/setting', 'as' => 'user.setting.'],
    function () {
        Route::get('', [SettingUserController::class, 'index'])->name('index');
    }
);
