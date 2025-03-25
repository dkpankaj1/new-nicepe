<?php
namespace App\Services;

use App\Contracts\UserServiceInterface;
use App\Enums\TransactionEnum;
use App\Enums\UserType;
use App\Helpers\TransactionHelper;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    public function createUser(array $data, string $type): User
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'postal_code' => $data['postal_code'],
            'wallet' => $data['wallet'] ?? 0,
            'type' => $type,
            'parent' => Auth::id(),
            'plan_id' => $data['plan'],
            'active' => $data['is_active'],
        ]);
        if ($user->type != UserType::ADMIN->value) {
            $user->transactions()->create([
                "transaction_type" => TransactionEnum::TYPE_INTERNAL->value,
                "transaction_direction" => TransactionEnum::DIRECTION_CREDIT->value,
                "vendor" => TransactionEnum::VENDOR_LOCAL->value,
                "transaction_id" => TransactionHelper::generateTransactionId(),
                "opening_balance" => $user->wallet,
                "amount" => $data['wallet'],
                "fee" => 0,
                "tax" => 0,
                "closing_balance" => $user->wallet + $data['wallet'],
                "currency_id" => TransactionHelper::getCurrency()->id,
                "payment_method" => TransactionEnum::METHOD_WALLET,
                "status" => TransactionEnum::STATUS_COMPLETE,
                "metadata" => ['message' => "initial balance"],
                "ip_address" => request()->ip(),
                "user_agent" => request()->userAgent(),
                "processed_at" => now(),
            ]);
        }
        
        return $user;
    }

    public function updateUser(User $user, array $data): User
    {
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'city' => $data['city'],
            'state' => $data['state'],
            'country' => $data['country'],
            'postal_code' => $data['postal_code'],
            'plan_id' => $data['plan'],
            'active' => $data['is_active'],
        ]);

        return $user;
    }

    public function deleteUser(User $user): bool
    {
        $user->update([
            'deleted_at' => now(),
            'active' => false,
        ]);

        return true;
    }
}