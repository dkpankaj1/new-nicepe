<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\BaseProfileController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends BaseProfileController
{
    protected function initializeViewProperties(){
        $this->accountView = "retailer.account.index";
        $this->profileUpdateView = "retailer.account.profile";
        $this->passwordUpdateView = "retailer.account.password";
    }
}
