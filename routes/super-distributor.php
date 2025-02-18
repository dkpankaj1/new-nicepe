<?php

use App\Http\Controllers\SuperDistributor\DashboardController;
use App\Http\Controllers\SuperDistributor\LoginController;
use App\Http\Controllers\SuperDistributor\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'super-distributor', 'as' => 'superdistributor.'], function () {

    Route::group(['middleware' => ['superdistributor:guest']], function () {

        Route::get('/', fn() => redirect()->route('apiclient.login'));
        Route::get('login', [LoginController::class, 'create'])->name('login');
        Route::post('login', [LoginController::class, 'store']);

    });
    Route::group(['middleware' => ['superdistributor:auth']], function () {

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

