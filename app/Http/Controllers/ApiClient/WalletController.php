<?php

namespace App\Http\Controllers\ApiClient;

use App\Datatables\ApiClient\WalletDatatable;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class WalletController extends Controller
{
    public function index(Request $request, WalletDatatable $walletDataTable)
    {
        return $request->expectsJson()
            ? $walletDataTable->get()
            : view('api-client.wallet.index');
    }
    public function show(Transaction $transaction)
    {
        Gate::authorize('view', $transaction);
        return view('api-client.wallet.show', ['transaction' => $transaction]);
    }
}
