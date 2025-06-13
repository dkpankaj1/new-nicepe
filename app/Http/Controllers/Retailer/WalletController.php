<?php

namespace App\Http\Controllers\Retailer;

use App\Datatables\Retailer\WalletDataTable;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WalletController extends Controller
{
    public function index(Request $request, WalletDataTable $walletDataTable)
    {
        return $request->expectsJson()
            ? $walletDataTable->get()
            : view('retailer.wallet.index');
    }
    public function show(Transaction $transaction)
    {
        Gate::authorize('view', $transaction);
        return view('retailer.wallet.show', ['transaction' => $transaction]);
    }
}
