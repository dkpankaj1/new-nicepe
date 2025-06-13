<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class ThrottleService
{
    public function generateKey(Request $request): string
    {
        return Str::lower($request->email) . '|' . $request->ip();
    }

    public function tooManyAttempts(string $key, int $maxAttempts): bool
    {
        return RateLimiter::tooManyAttempts($key, $maxAttempts);
    }

    public function hit(string $key): void
    {
        RateLimiter::hit($key);
    }

    public function clear(string $key): void
    {
        RateLimiter::clear($key);
    }

    public function throwThrottleException(string $key): void
    {
        $seconds = RateLimiter::availableIn($key);
        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }
}