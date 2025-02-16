<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BalanceTransfer extends Model
{
    protected $fillable = [
        'from_user',
        'to_user',
        'transaction_id',
        'amount',
        'notes',
        'status',
    ];

    /**
     * Get the user who initiated the transfer.
     *
     * @return BelongsTo
     */
    public function fromUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    /**
     * Get the user who received the transfer.
     *
     * @return BelongsTo
     */
    public function toUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'to_user');
    }

    /**
     * Get the associated transaction.
     *
     * @return BelongsTo
     */
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
