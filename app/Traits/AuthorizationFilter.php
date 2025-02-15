<?php
namespace App\Traits;

use App\Exceptions\Unauthorize;
use Illuminate\Support\Facades\Gate;


trait AuthorizationFilter
{
    protected function applyAuthorization(array $permissions)
    {
        $action = request()->route()->getActionMethod();
        if (Gate::denies($permissions[$action])) {
            throw new Unauthorize();
        }
    }
    protected function check($ability, ...$args)
    {
        if (Gate::denies($ability, $args)) {
            throw new Unauthorize();
        }
    }
}