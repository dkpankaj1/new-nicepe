<?php

namespace App\Http\Controllers\SuperDistributor;

use App\Datatables\SuperDistributor\WalletDatatable;
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
            : view('super-distributor.wallet.index');
    }
    public function show(Transaction $transaction)
    {
        Gate::authorize('view', $transaction);
        return view('super-distributor.wallet.show', ['transaction' => $transaction]);
    }
}
