<?php

namespace App\Http\Controllers\ApiClient;

use App\Enums\UserType;
use App\Http\Controllers\BaseAuthController;

class LoginController extends BaseAuthController
{
    protected UserType $userType = UserType::APICLIENT;
    protected string $loginView = 'api-client.auth.login';
    protected string $loginRoute = 'apiclient.login';
    protected string $dashboardRoute = 'apiclient.dashboard';

}
