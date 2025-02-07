<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $fillable = [
        'code',
        'name',
        'fee',
        'description',
        'image',
        'active',
    ];
}
