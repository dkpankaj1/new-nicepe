<?php
namespace App\Services;

class UserCommissionService
{
    protected $feature;
    protected $user;

    public function __construct($user, $feature)
    {
        $this->user = $user;
        $this->feature = $feature;
    }
    public function getParent(){
        return $this->user->userParent;
    }
}