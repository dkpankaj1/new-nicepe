<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EkycOtp extends Model
{
    protected $fillable = [
        'aadhaar_number',
        'transaction_id',
        'otp',
        'is_expite',
    ];
}
