<?php

namespace App\Http\Controllers\Retailer;

use App\Enums\TransactionEnum;
use App\Exceptions\insufficientBalanceException;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\UserPlanService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $userPlan = new UserPlanService(Auth::user()->id);

        $transactions = Transaction::where('user_id', Auth::user()->id)
            ->whereNot('status', TransactionEnum::STATUS_PENDING)
            ->latest()->take(5)->get();

        return view('retailer.pages.dashboard', [
            'transactions' => $transactions,
            'plans' => $userPlan->plans()
        ]);
    }
}
