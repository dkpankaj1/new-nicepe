<?php

namespace App\Http\Controllers\Retailer;

use App\Enums\UserType;
use App\Http\Controllers\BaseAuthController;

class LoginController extends BaseAuthController
{
    protected UserType $userType = UserType::RETAILER;
    protected string $loginView = 'retailer.auth.login';
    protected string $loginRoute = 'retailer.login';
    protected string $dashboardRoute = 'retailer.dashboard';

}
