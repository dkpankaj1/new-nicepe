<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanDetail extends Model
{
    protected $fillable = [
        "plan_id",
        "feature_id",
        "fee",
        "activete"
    ];
    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
