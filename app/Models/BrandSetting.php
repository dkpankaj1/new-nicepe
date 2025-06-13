<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandSetting extends Model
{
    protected $fillable = [
        "name",
        "title",
        "description",
        "logo",
        "logo_light",
        "logo_dark",
        "favicon",
        "contact_email",
        "contact_phone",
    ];

    public function getLogoAttribute($attribute)
    {
        return $attribute ? asset('storage/' . $attribute) : 'https://placehold.co/94x99';
    }

    public function getLogoLightAttribute($attribute)
    {
        return $attribute ? asset('storage/' . $attribute) : 'https://placehold.co/244x68';
    }
    public function getLogoDarkAttribute($attribute)
    {
        return $attribute ? asset('storage/' . $attribute) : 'https://placehold.co/244x68';
    }
    public function getFaviconAttribute($attribute)
    {
        return $attribute ? asset('storage/' . $attribute) : 'https://placehold.co/32x32';
    }
}
