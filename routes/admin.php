<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin:guest']], function () {

    Route::get('/', fn() => redirect()->route('admin.login'));

    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin:auth']], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // resource route
    Route::resource('features', FeatureController::class)->only(['index', 'show', 'edit', 'update']);
    Route::resource('plans', PlanController::class);
    Route::resource('roles', RoleController::class);

    Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('index');
        Route::get('update', [ProfileController::class, 'account'])->name('update');
        Route::put('/update', [ProfileController::class, 'accountUpdate']);
        Route::get('/password', [ProfileController::class, 'password'])->name('password');
        Route::patch('/password', [ProfileController::class, 'passwordUpdate']);
    });

    Route::group(['prefix' => 'setting', 'as' => 'setting.'], function () {
        Route::get('brand-setting', [SettingController::class, 'brandSetting'])->name('brand');
        Route::put('/brand-setting', [SettingController::class, 'brandSettingUpdate']);
        Route::get('/general-setting', [SettingController::class, 'generalSetting'])->name('general');
        Route::put('/general-setting', [SettingController::class, 'generalSettingUpdate']);
        Route::get('/email-setting', [SettingController::class, 'emailConfigrution'])->name('email');
        Route::put('/email-setting', [SettingController::class, 'emailConfigrutionUpdate']);
    });


    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

});