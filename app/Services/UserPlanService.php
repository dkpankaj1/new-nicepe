<?php
namespace App\Services;

use App\Models\User;

class UserPlanService
{
    protected $user;

    public function __construct($userId)
    {
        $this->user = User::find($userId);
    }
    public function plans()
    {
        return $this->user->plan()->with(['planDetails.feature'])->first() ?? (object)[];
    }
}