<?php

namespace App\Http\Controllers\SuperDistributor;

use App\Enums\UserType;
use App\Http\Controllers\BaseAuthController;

class LoginController extends BaseAuthController
{
    protected UserType $userType = UserType::SUPERDISTRIBUTOR;
    protected string $loginView = 'super-distributor.auth.login';
    protected string $loginRoute = 'superdistributor.login';
    protected string $dashboardRoute = 'superdistributor.dashboard';

}
