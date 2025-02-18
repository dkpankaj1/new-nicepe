<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class DistributorAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,string $type): Response
    {
        $user = Auth::user();

        if ($type === 'auth' && (!$user || $user->type !== UserType::DISTRIBUTOR->value)) {
            return redirect()->route('distributor.login');
        }

        if ($type === 'guest' && $user?->type === UserType::DISTRIBUTOR->value) {
            return redirect()->route('distributor.dashboard');
        }

        return $next($request);
    }
}
