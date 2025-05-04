<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AadharMobileUpdate extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'parent',
        'aadhar',
        'mobile',
        'email',

        'fingerprint1',
        'fingerprint2',
        'fingerprint3',
        'fingerprint4',
        'fingerprint5',

        'status',

        'forward_transaction',
        'refund_transaction',

        'recept',

        'remark',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
