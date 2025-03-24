<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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
    public function scopeWithCurrentUser(Builder $query): Builder
    {
        return $query->where('user_id', Auth::id());
    }
}
