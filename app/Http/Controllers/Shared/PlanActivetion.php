<?php

namespace App\Http\Controllers\Shared;

use App\Exceptions\insufficientBalanceException;
use App\Http\Controllers\Controller;
use App\Models\PlanDetail;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

abstract class PlanActivetion extends Controller
{
    abstract public function edit(PlanDetail $planDetail);

    public function update(Request $request, PlanDetail $planDetail)
    {
        Gate::authorize('update', $planDetail);

        throw_if(
            $request->user->wallet < $planDetail->feature->activation_fee,
            new insufficientBalanceException(route('retailer.wallet-recharge.create'))
        );

    }

}
