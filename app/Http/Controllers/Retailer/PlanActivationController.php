<?php

namespace App\Http\Controllers\Retailer;

use App\Http\Controllers\Shared\PlanActivetion;
use App\Models\PlanDetail;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PlanActivationController extends PlanActivetion
{
    public function edit(PlanDetail $planDetail)
    {
        dd(Auth::user()->id);
      
        dd($planDetail->plan);
        // Gate::authorize('update',$planDetail);
        
        return view('shared.plan-activation', [
            'planDetails' => $planDetail,
            'breadcrumb' => Breadcrumbs::render(''),
            'action' => '#'
        ]);
    }

}
