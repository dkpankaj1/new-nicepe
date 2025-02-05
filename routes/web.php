<?php

use App\Services\ToasterService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    ToasterService::error('test message');
    return view('welcome');
});
