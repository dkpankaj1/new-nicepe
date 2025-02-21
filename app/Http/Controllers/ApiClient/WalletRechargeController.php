<?php

namespace App\Http\Controllers\ApiClient;

use App\Enums\TransactionEnum;
use App\Helpers\TransactionHelper;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\NicePeService;
use App\Services\ToasterService;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletRechargeController extends Controller
{
    public function create()
    {
        return view('shared.payment.create', [
            'action' => route('apiclient.wallet-recharge.store'),
            'breadcrumb' => Breadcrumbs::render('apiclient.wallet-recharge.create')
        ]);
    }
    public function store(Request $request, NicePeService $nicePeService)
    {
        $request->validate([
            'amount' => ['required', 'numeric', 'min:0', 'max:5000']
        ]);

        try {
            $user = Auth::user();

            $transaction = Transaction::create([
                'user_id' => $user->id,
                'transaction_type' => TransactionEnum::TYPE_EXTERNAL,
                'transaction_direction' => TransactionEnum::DIRECTION_CREDIT,
                'vendor' => TransactionEnum::VENDOR_NICEPE,
                'transaction_id' => TransactionHelper::generateTransactionId(),
                'opening_balance' => $user->wallet,
                'amount' => $request->amount,
                'fee' => 0,
                'tax' => 0,
                'closing_balance' => $user->wallet + $request->amount,
                'currency_id' => TransactionHelper::getCurrency()->id,
                'payment_method' => TransactionEnum::METHOD_WALLET,
                'status' => TransactionEnum::STATUS_PENDING,
                'metadata' => ['message' => "online wallet recharge"],
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            $initData = $nicePeService->initiatePayment($transaction, route('apiclient.wallet-recharge.nicepe.redirect'));

            return view('shared.payment.nicepe', [
                'transactionData' => $initData['transactionData'],
                'checksum' => $initData['checksum'],
                'baseUrl' => $initData['baseUrl']
            ]);

        } catch (Exception $e) {
            dd($e->getMessage());
            ToasterService::error(__('message.error.default'));
            return redirect()->back();
        }
    }
    public function response(Request $request, NicePeService $nicePeService)
    {
        $status = $request->input('status', 'FAILED');

        if ($status == "SUCCESS") {
            $nicePeService->handleRedirect($request->all())
                ? ToasterService::success(__('message.success.default'))
                : ToasterService::error(__('message.error.default'));
            return redirect()->route('apiclient.wallet.index');
        }

        ToasterService::error(__('message.custom.something_went_wrong'));
        return redirect()->route('apiclient.wallet.index');
    }
}
