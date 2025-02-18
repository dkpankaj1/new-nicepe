<?php

use App\Http\Controllers\Retailer\DashboardController;
use App\Http\Controllers\Retailer\LoginController;
use App\Http\Controllers\Retailer\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'retailer', 'as' => 'retailer.'], function () {

    Route::group(['middleware' => ['retailer:guest']], function () {

        Route::get('/', fn() => redirect()->route('apiclient.login'));
        Route::get('login', [LoginController::class, 'create'])->name('login');
        Route::post('login', [LoginController::class, 'store']);

    });
    Route::group(['middleware' => ['retailer:auth']], function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'account', 'as' => 'account.'], function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::get('update', [ProfileController::class, 'account'])->name('update');
            Route::put('/update', [ProfileController::class, 'accountUpdate']);
            Route::get('/password', [ProfileController::class, 'password'])->name('password');
            Route::patch('/password', [ProfileController::class, 'passwordUpdate']);
        });
        
        Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    });

});

