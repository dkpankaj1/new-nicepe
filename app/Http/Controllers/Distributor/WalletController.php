<?php

namespace App\Http\Controllers\Distributor;

use App\Datatables\Distributor\WalletDatatable;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WalletController extends Controller
{
    public function index(Request $request, WalletDatatable $walletDataTable)
    {
        return $request->expectsJson()
            ? $walletDataTable->get()
            : view('distributor.wallet.index');
    }
    public function show(Transaction $transaction)
    {
        Gate::authorize('view', $transaction);
        return view('distributor.wallet.show', ['transaction' => $transaction]);
    }
}
