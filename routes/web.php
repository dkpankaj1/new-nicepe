<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/term-and-condition', function () {
    return view('term-and-condition');
})->name('term-and-condition');

Route::get('/cancellation-and-refund-policy', function () {
    return view('payment-policy');
})->name('payment-policy');

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
})->name('privacy-policy'); 
