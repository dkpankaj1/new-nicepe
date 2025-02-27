<?php

namespace App\Services;

use App\Enums\TransactionEnum;
use App\Exceptions\insufficientBalanceException;
use App\Helpers\TransactionHelper;
use App\Models\Transaction;
use App\Models\User;

class TransactionService
{
    protected User $user;
    protected float $amount;
    protected TransactionEnum $transactionType;
    protected TransactionEnum $transactionDirection;
    protected ?TransactionEnum $vendor = null;
    protected float $fee = 0;
    protected float $tax = 0;
    protected ?TransactionEnum $paymentMethod = null;
    protected TransactionEnum $status = TransactionEnum::STATUS_PENDING;
    protected ?array $metadata = null;

    public function setUser(User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function setAmount(float $amount): self
    {
        $this->amount = $amount;
        return $this;
    }

    public function setTransactionType(TransactionEnum $type): self
    {
        $this->transactionType = $type;
        return $this;
    }

    public function setTransactionDirection(TransactionEnum $direction): self
    {
        $this->transactionDirection = $direction;
        return $this;
    }

    public function setVendor(?TransactionEnum $vendor): self
    {
        $this->vendor = $vendor;
        return $this;
    }

    public function setFee(float $fee): self
    {
        $this->fee = $fee;
        return $this;
    }

    public function setTax(float $tax): self
    {
        $this->tax = $tax;
        return $this;
    }

    public function setPaymentMethod(?TransactionEnum $method): self
    {
        $this->paymentMethod = $method;
        return $this;
    }

    public function setStatus(TransactionEnum $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function setMetadata(?array $metadata): self
    {
        $this->metadata = $metadata;
        return $this;
    }

    public function processTransaction(): Transaction
    {
        // Get user balance
        $currentBalance = $this->user->wallet;

        // Check if user has sufficient balance
        if ($this->amount > $currentBalance) {
            throw new insufficientBalanceException();
        }

        // Calculate closing balance
        $closingBalance = $currentBalance - $this->amount - $this->fee - $this->tax;

        // Create Transaction
        $transaction = Transaction::create([
            "user_id" => $this->user->id,
            "transaction_type" => $this->transactionType,
            "transaction_direction" => $this->transactionDirection,
            "vendor" => $this->vendor,
            'transaction_id' => TransactionHelper::generateTransactionId(),
            "opening_balance" => $currentBalance,
            "amount" => $this->amount,
            "fee" => $this->fee,
            "tax" => $this->tax,
            "closing_balance" => $closingBalance,
            'currency_id' => TransactionHelper::getCurrency()->id,
            "payment_method" => $this->paymentMethod,
            "status" => $this->status,
            "metadata" => $this->metadata,
            "ip_address" => request()->ip(),
            "user_agent" => request()->userAgent(),
            "processed_at" => now(),
        ]);

        // Update User Balance
        $this->user->update(['wallet' => $closingBalance]);

        return $transaction;
    }

}