<?php
namespace App\Contracts;

use App\Models\Transaction;

interface PaymentGatewayInterface
{
    public function initiatePayment(Transaction $transaction,$redirectUrl):array;
    public function handleRedirect(array $requestData):bool;
}
