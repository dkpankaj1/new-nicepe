<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;

class AadharEmailUpdate extends Model
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
    protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
