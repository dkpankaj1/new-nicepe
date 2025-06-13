<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Services\ThrottleService;
use App\Services\ToasterService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    private ThrottleService $throttleService;

    public function __construct(ThrottleService $throttleService)
    {
        $this->throttleService = $throttleService;
    }
    public function create(): \Illuminate\View\View
    {
        return view('admin.auth.login');
    }

    public function store(Request $request, LoginAction $loginAction): \Illuminate\Http\RedirectResponse
    {
        $this->validateLoginRequest($request);

        $key = $this->throttleService->generateKey($request);

        if ($this->throttleService->tooManyAttempts($key, 5)) {
            $this->throttleService->throwThrottleException($key);
        }

        if (!$loginAction->execute($request, UserType::ADMIN)) {
            $this->throttleService->hit($key);
            throw ValidationException::withMessages(['email' => trans('auth.failed')]);
        }

        $this->throttleService->clear($key);

        ToasterService::success('Login Successful');
        return redirect()->route('admin.dashboard');
    }

    public function destroy(Request $request, LogoutAction $logoutAction): \Illuminate\Http\RedirectResponse
    {
        $logoutAction->execute($request);
        ToasterService::success('Logout Successful');
        return redirect()->route('admin.login');
    }

    private function validateLoginRequest(Request $request): void
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }
}
