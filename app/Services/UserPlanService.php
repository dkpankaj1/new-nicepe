<?php
namespace App\Services;

use App\Models\User;
use App\Models\UserActivation;

class UserPlanService
{
    protected $user;

    public function __construct($userId)
    {
        $this->user = User::find($userId);
    }
    public function plans()
    {
        $plan = $this->user->plan()->with(['planDetails.feature'])->first();

        return $plan ? (object) [
            'id' => $plan->id,
            'name' => $plan->name,
            'description' => $plan->description,
            'details' => $plan->planDetails->map(function ($planDetail) {
                return (object) [
                    "id" => $planDetail->id,
                    "feature_id" => $planDetail->feature_id,
                    "feature_name" => $planDetail->feature->name,
                    "icon" => $planDetail->feature->image,
                    "fee" => $planDetail->fee,
                    "activation_fee" => $planDetail->feature->activation_fee,
                    'isactive' => UserActivation::where('user_id', $this->user->id)
                        ->where('feature_id', $planDetail->feature_id)
                        ->exists() ?? false
                ];
            })
        ] : null;
    }
}