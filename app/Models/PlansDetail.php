<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlansDetail extends Model
{
    protected $fillable = [
        'plan_id',
        'feature_id',
        'fee',
    ];

}
