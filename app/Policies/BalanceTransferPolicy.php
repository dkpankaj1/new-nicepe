<?php

namespace App\Policies;

use App\Models\BalanceTransfer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BalanceTransferPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BalanceTransfer $balanceTransfer): bool
    {
        return $balanceTransfer->from_user == $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BalanceTransfer $balanceTransfer): bool
    {
        return $balanceTransfer->from_user == $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BalanceTransfer $balanceTransfer): bool
    {
        return $balanceTransfer->from_user == $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BalanceTransfer $balanceTransfer): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BalanceTransfer $balanceTransfer): bool
    {
        return false;
    }
}
