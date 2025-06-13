<?php

namespace App\Actions\Auth;

use App\Enums\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginAction
{
    public function execute(Request $request, UserType $userType)
    {
        return Auth::attempt(
            $request->only('email', 'password') + ['active' => true, 'type' => $userType->value],
            $request->boolean('remember')
        );
    }
}