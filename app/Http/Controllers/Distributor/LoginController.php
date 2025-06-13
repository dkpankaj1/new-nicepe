<?php

namespace App\Http\Controllers\Distributor;

use App\Enums\UserType;
use App\Http\Controllers\BaseAuthController;

class LoginController extends BaseAuthController
{
    protected UserType $userType = UserType::DISTRIBUTOR;
    protected string $loginView = 'distributor.auth.login';
    protected string $loginRoute = 'distributor.login';
    protected string $dashboardRoute = 'distributor.dashboard';
}
