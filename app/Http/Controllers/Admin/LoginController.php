<?php

namespace App\Http\Controllers\Admin;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Services\ToasterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function create(): \Illuminate\View\View
    {
        return view('admin.auth.login');
    }

    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $key = $this->throttleKey($request);

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->throwThrottleException($key);
        }

        if (!Auth::attempt($request->only('email', 'password') + ['active' => true, 'type' => UserType::ADMIN->value], $request->boolean('remember'))) {
            RateLimiter::hit($key);
            throw ValidationException::withMessages(['email' => trans('auth.failed')]);
        }

        RateLimiter::clear($key);

        ToasterService::success('Login Successful');
        return redirect()->route('admin.dashboard');
    }

    public function destroy(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        ToasterService::success('Logout Successful');
        return redirect()->route('admin.login');
    }

    private function throttleKey(Request $request): string
    {
        return Str::lower($request->email) . '|' . $request->ip();
    }

    private function throwThrottleException(string $key): void
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
