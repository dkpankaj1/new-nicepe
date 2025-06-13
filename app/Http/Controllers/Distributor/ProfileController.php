<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\BaseProfileController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends BaseProfileController
{
    protected function initializeViewProperties()
    {
        $this->accountView = "distributor.account.index";
        $this->profileUpdateView = "distributor.account.profile";
        $this->passwordUpdateView = "distributor.account.password";
    }
}
