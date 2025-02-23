<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'deleted_at'
    ];

    public function planDetails()
    {
        return $this->hasMany(PlanDetail::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
