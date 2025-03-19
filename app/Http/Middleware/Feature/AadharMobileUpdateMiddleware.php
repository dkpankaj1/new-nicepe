<?php

namespace App\Http\Middleware\Feature;

use App\Features\AadharMobileUpdateFeature;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AadharMobileUpdateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!AadharMobileUpdateFeature::isFeatureAvailableForUser()) {
            abort(404);
        }
        return $next($request);
    }
}
