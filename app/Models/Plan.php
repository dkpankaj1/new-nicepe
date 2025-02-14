<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
    ];

    public function planDetails()
    {
        return $this->hasMany(PlanDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
