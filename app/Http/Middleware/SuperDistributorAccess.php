<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperDistributorAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,string $type): Response
    {
        $user = Auth::user();

        if ($type === 'auth' && (!$user || $user->type !== UserType::SUPERDISTRIBUTOR->value)) {
            return redirect()->route('superdistributor.login');
        }

        if ($type === 'guest' && $user?->type === UserType::SUPERDISTRIBUTOR->value) {
            return redirect()->route('superdistributor.dashboard');
        }

        return $next($request);
    }
}
