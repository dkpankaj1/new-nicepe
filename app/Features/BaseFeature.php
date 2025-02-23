<?php

namespace App\Features;

use App\Models\Feature;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

abstract class BaseFeature
{
    protected static $code;
    public static function isEnabled(): bool
    {
        $feature = Feature::where('code', static::$code)->first();
        return $feature ? $feature->enable : false;
    }
    public static function getFeatureCode(): string
    {
        return static::$code;
    }
    public static function getActivationFee(): float
    {
        $feature = Feature::where('code', static::$code)->first();
        return $feature ? $feature->activation_fee : 0.0;
    }

    public static function isEnableForUser(): bool
    {
        $user = User::find(Auth::user()->id);
        return $user->plan?->planDetails()->whereHas('feature', function ($query) {
            $query->where('code', static::$code);
        })->exists() ?? false;
    }
}
