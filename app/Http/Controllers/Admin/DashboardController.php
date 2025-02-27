<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $recentUsers = User::latest()->take(5)->get();
        $apiClientCount = User::where('type', UserType::APICLIENT)->count();
        $superDistributorCount = User::where('type', UserType::SUPERDISTRIBUTOR)->count();
        $distributorCount = User::where('type', UserType::DISTRIBUTOR)->count();
        $retailerCount = User::where('type', UserType::RETAILER)->count();

        $activityLogs = ActivityLog::latest()->take(7)->get();


        return view('admin.pages.dashboard', [
            'recentUsers' => $recentUsers,
            'apiClientCount' => $apiClientCount,
            'superDistributorCount' => $superDistributorCount,
            'distributorCount' => $distributorCount,
            'retailerCount' => $retailerCount,
            'activityLogs' => $activityLogs
        ]);
    }
}
