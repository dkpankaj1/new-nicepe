<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AadharToPan extends Model
{
    protected $fillable = [
        'user_id',
        'fullname',
        'parent',
        'dob',
        'aadhar',
        'mobile',
        'status',
    ];
}
