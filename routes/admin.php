<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin:guest']], function () {

    Route::get('/', fn() => redirect()->route('admin.login'));

    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin:auth']], function () {

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

});