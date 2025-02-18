<?php
namespace App\Http\Controllers;

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Enums\UserType;
use App\Services\ThrottleService;
use App\Services\ToasterService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

abstract class BaseAuthController extends Controller
{
    protected ThrottleService $throttleService;
    protected UserType $userType;
    protected string $loginView;
    protected string $loginRoute;
    protected string $dashboardRoute;

    public function __construct(ThrottleService $throttleService)
    {
        $this->throttleService = $throttleService;
    }

    public function create()
    {
        return view($this->loginView);
    }

    public function store(Request $request, LoginAction $loginAction)
    {
        $this->validateLoginRequest($request);

        $key = $this->throttleService->generateKey($request);

        if ($this->throttleService->tooManyAttempts($key, 5)) {
            $this->throttleService->throwThrottleException($key);
        }

        if (!$loginAction->execute($request, $this->userType)) {
            $this->throttleService->hit($key);
            throw ValidationException::withMessages(['email' => trans('auth.failed')]);
        }

        $this->throttleService->clear($key);

        ToasterService::success('Login Successful');
        return redirect()->route($this->dashboardRoute);
    }

    public function destroy(Request $request, LogoutAction $logoutAction)
    {
        $logoutAction->execute($request);
        ToasterService::success('Logout Successful');
        return redirect()->route($this->loginRoute);
    }

    private function validateLoginRequest(Request $request): void
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }

}