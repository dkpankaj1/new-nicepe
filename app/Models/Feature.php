<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'code',
        'name',
        'fee',
        'activation_fee',
        'description',
        'image',
        'enable',
    ];

    public function getImageAttribute($attribute)
    {
        return $attribute ? asset('storage/' . $attribute): 'https://placehold.co/200x200';
    }

    public function planDetails()
    {
        return $this->hasMany(PlanDetail::class);
    }
    public function rewards(){
        return $this->hasMany(Reward::class);
    }
}
