<?php

namespace App\Http\Controllers\ApiClient;

use App\Http\Controllers\BaseProfileController;


class ProfileController extends BaseProfileController
{
    protected function initializeViewProperties(){
        $this->accountView = "api-client.account.index";
        $this->profileUpdateView = "api-client.account.profile";
        $this->passwordUpdateView = "api-client.account.password";
    }
}
