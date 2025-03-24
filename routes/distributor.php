<?php

use App\Http\Controllers\Distributor\DashboardController;
use App\Http\Controllers\Distributor\LoginController;
use App\Http\Controllers\Distributor\MyPlanController;
use App\Http\Controllers\Distributor\PlanController as DistributorPlanController;
use App\Http\Controllers\Distributor\ProfileController;
use App\Http\Controllers\Distributor\RetailerController;
use App\Http\Controllers\Distributor\WalletController;
use App\Http\Controllers\Distributor\WalletRechargeController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'distributor', 'as' => 'distributor.'], function () {

    Route::group(['middleware' => ['distributor:guest']], function () {

        Route::get('/', fn() => redirect()->route('distributor.login'));
        Route::get('login', [LoginController::class, 'create'])->name('login');
        Route::post('login', [LoginController::class, 'store']);

        Route::group(['prefix' => 'wallet-recharge', 'as' => 'wallet-recharge.'], function () {
            Route::any('nicepe/redirect', [WalletRechargeController::class, 'response'])
                ->withoutMiddleware(['web'])->name('nicepe.redirect');
        });

    });
    Route::group(['middleware' => ['distributor:auth']], function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('plans', DistributorPlanController::class);

        Route::resource('retailers', RetailerController::class);

        Route::prefix('my-plan')->name('myplan.')->group(function () {
            Route::get('/', [MyPlanController::class, 'index'])->name('index');
            Route::get('{planDetail}/activation', [MyPlanController::class, 'activation'])->name('activation');
            Route::put('{planDetail}/activation', [MyPlanController::class, 'processActivation'])->name('processActivation');
        });

        Route::group(['prefix' => 'wallet', 'as' => 'wallet.'], function () {
            Route::get('/', [WalletController::class, 'index'])->name('index');
            Route::get('{transaction}/show', [WalletController::class, 'show'])->name('show');
        });

        Route::group(['prefix' => 'wallet-recharge', 'as' => 'wallet-recharge.'], function () {
            Route::get('/', [WalletRechargeController::class, 'create'])->name('create');
            Route::post('/', [WalletRechargeController::class, 'store'])->name('store');
        });

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

