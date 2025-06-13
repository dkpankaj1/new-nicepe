<?php
namespace App\Services;

use App\Contracts\PaymentGatewayInterface;
use App\Enums\TransactionEnum;
use App\Helpers\NicePeCheckSum;
use App\Models\Transaction;

class NicePeService implements PaymentGatewayInterface
{
    public function initiatePayment(Transaction $transaction, $redirectUrl): array
    {
        $config = config('pg.nicepe');
        $transactionData = [
            'upiuid' => $config['upi_id'],
            'token' => $config['token'],
            'orderId' => $transaction->transaction_id,
            'txnAmount' => $transaction->amount,
            'txnNote' => 'no notes',
            "cust_Email" => $transaction->user->email,
            "cust_Mobile" => $transaction->user->phone,
            'callback_url' => $redirectUrl,
        ];

        $checksum = NicePeCheckSum::generateSignature($transactionData, $config['secret_key']);
        return [
            'transactionData' => $transactionData,
            'checksum' => $checksum,
            'baseUrl' => $config['base_url'],
        ];
    }
    public function handleRedirect(array $requestData): bool
    {
        $config = config('pg.nicepe');
        $checksum = $requestData['checksum'];
        $param = NicePeCheckSum::hashDecrypt($requestData['hash'], $config['secret_key']);
        $isVerify = NicePeCheckSum::verifySignature($param, $config['secret_key'], $checksum);

        $decodedParam = json_decode($param, true);
        $transaction = Transaction::where('transaction_id', $decodedParam['orderId'])->first();

        if (
            $isVerify &&
            $decodedParam['txnStatus'] === "TXN_SUCCESS" &&
            $transaction->status === TransactionEnum::STATUS_PENDING->value
        ) {
            $transaction->update([
                'payment_method' => $decodedParam['paymentMode'],
                'status' => TransactionEnum::STATUS_COMPLETE->value,
            ]);
            $transaction->user->increment('wallet', $decodedParam['txnAmount']);
            return true;
        }

        return false;
    }
}