<?php

namespace App\Http\Controllers\SuperDistributor;

use App\Enums\TransactionEnum;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)
            ->whereNot('status', TransactionEnum::STATUS_PENDING)
            ->latest()->take(5)->get();

        return view('super-distributor.pages.dashboard', [
            'transactions' => $transactions
        ]);

    }
}
