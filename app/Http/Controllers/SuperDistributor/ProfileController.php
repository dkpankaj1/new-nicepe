<?php

namespace App\Http\Controllers\SuperDistributor;

use App\Http\Controllers\BaseProfileController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends BaseProfileController
{
    protected function initializeViewProperties()
    {
        $this->accountView = "super-distributor.account.index";
        $this->profileUpdateView = "super-distributor.account.profile";
        $this->passwordUpdateView = "super-distributor.account.password";
    }
}
