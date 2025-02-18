<?php

namespace App\Http\Controllers\ApiClient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        return view('api-client.pages.dashboard');
    }
}
