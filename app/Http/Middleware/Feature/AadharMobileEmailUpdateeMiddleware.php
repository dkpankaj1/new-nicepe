<?php

namespace App\Http\Middleware\Feature;

use App\Features\AadharMobileEmailUpdateFeature;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AadharMobileEmailUpdateeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!AadharMobileEmailUpdateFeature::isFeatureAvailableForUser()) {
            abort(404);
        }
        return $next($request);
    }
}
