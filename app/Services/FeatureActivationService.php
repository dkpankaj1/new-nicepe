<?php
namespace App\Services;

use App\Enums\TransactionEnum;
use App\Models\Feature;
use App\Models\Plan;
use App\Models\PlanDetail;
use App\Models\User;
use App\Models\UserActivation;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class FeatureActivationService
{
    protected User $user;
    protected Feature $feature;
    protected TransactionService $transactionService;

    public function __construct(User $user, Feature $feature, TransactionService $transactionService)
    {
        $this->user = $user;
        $this->feature = $feature;
        $this->transactionService = $transactionService;
    }

    /**
     * Check if the feature is already activated for the user.
     */
    public function isFeatureAlreadyActivated(): bool
    {
        return UserActivation::where('user_id', $this->user->id)
            ->where('feature_id', $this->feature->id)
            ->exists();
    }

    /**
     * Activate feature for the user.
     */
    public function activate(): bool
    {
        if ($this->isFeatureAlreadyActivated()) {
            Log::warning("Feature already activated.");
            return false;
        }
        if (!$this->hasFeature()) {
            Log::warning("Feature not in user plan.");
            return false;
        }
        $this->transactionService
            ->setUser($this->user)
            ->setTransactionType(TransactionEnum::TYPE_INTERNAL)
            ->setTransactionDirection(TransactionEnum::DIRECTION_DEBIT)
            ->setVendor(TransactionEnum::VENDOR_LOCAL)
            ->setAmount((float) $this->feature->activation_fee)
            ->setFee(0)
            ->setTax(0)
            ->setPaymentMethod(TransactionEnum::METHOD_WALLET)
            ->setStatus(TransactionEnum::STATUS_COMPLETE)
            ->setMetadata([
                'message' => "Feature activation",
                'feature' => $this->feature->name
            ])
            ->processTransaction();
        // Create activation record
        UserActivation::create([
            'user_id' => $this->user->id,
            'feature_id' => $this->feature->id,
            'fee' => (float) $this->feature->activation_fee,
            'activation_date' => now(),
            'expiry_date' => Carbon::now()->addYear(),
        ]);

        return true;
    }
    public function hasFeature(): bool
    {
        return PlanDetail::where('plan_id', $this->user->plan_id)
            ->where('feature_id', $this->feature->id)
            ->exists();

    }
}
