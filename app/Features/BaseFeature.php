<?php

namespace App\Features;

use App\Models\Feature;
use App\Models\User;
use App\Models\UserActivation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

abstract class BaseFeature
{
    protected static $code;

    public static function isEnabled(): bool
    {
        try {
            $feature = Feature::where('code', static::$code)->first();
            return $feature ? $feature->enable : false;
        } catch (Exception $e) {
            Log::error('Error checking feature enabled status for code ' . static::$code . ': ' . $e->getMessage());
            return false;
        }
    }

    public static function getFeatureCode(): string
    {
        try {
            return static::$code;
        } catch (Exception $e) {
            Log::error('Error getting feature code: ' . $e->getMessage());
            return '';
        }
    }

    public static function getFeatureDetail()
    {
        try {
            $feature = Feature::where('code', static::$code)->first();
            return $feature ? $feature : collect([]);
        } catch (Exception $e) {
            Log::error('Error getting feature detail for code ' . static::$code . ': ' . $e->getMessage());
            return collect([]);
        }
    }

    public static function getActivationFee(): float
    {
        try {
            $feature = Feature::where('code', static::$code)->first();
            return $feature ? (float) $feature->activation_fee : 0.0;
        } catch (Exception $e) {
            Log::error('Error getting activation fee for code ' . static::$code . ': ' . $e->getMessage());
            return 0.0;
        }
    }

    public static function isEnableForUser(): bool
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return false;
            }
            return $user->plan?->planDetails()->whereHas('feature', function ($query) {
                $query->where('code', static::$code)->where('enable', true);
            })->exists() ?? false;
        } catch (Exception $e) {
            Log::error('Error checking if feature is enabled for user for code ' . static::$code . ': ' . $e->getMessage());
            return false;
        }
    }

    public static function isActiveForUser(): bool
    {
        try {
            $userId = Auth::id();
            if (!$userId) {
                return false;
            }
            return UserActivation::where('user_id', $userId)
                ->whereHas('feature', fn($query) => $query->where('code', static::$code))
                ->exists() ?? false;
        } catch (Exception $e) {
            Log::error('Error checking if feature is active for user for code ' . static::$code . ': ' . $e->getMessage());
            return false;
        }
    }

    public static function isFeatureAvailableForUser(): bool
    {
        try {
            $userId = Auth::id();
            if (!$userId) {
                return false;
            }

            if (
                !UserActivation::where('user_id', $userId)
                    ->whereHas('feature', fn($query) => $query->where('code', static::$code))
                    ->exists()
            ) {
                return false;
            }

            return User::where('id', $userId)
                ->whereHas(
                    'plan.planDetails',
                    fn($query) =>
                    $query->whereHas(
                        'feature',
                        fn($query) =>
                        $query->where('code', static::$code)->where('enable', true)
                    )
                )->exists();
        } catch (Exception $e) {
            Log::error('Error checking if feature is available for user for code ' . static::$code . ': ' . $e->getMessage());
            return false;
        }
    }
}