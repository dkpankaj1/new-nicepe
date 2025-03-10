<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AadharMobileEmailUpdate extends Model
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
        'recept',
        'remark',
    ];
}
