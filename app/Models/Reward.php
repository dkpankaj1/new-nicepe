<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = [
        'feature_id',
        'name',
        'description',
        'point',
        'reward_type',
        'expiry_date',
        'enable',
    ];

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
