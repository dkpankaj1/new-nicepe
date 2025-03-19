<?php

namespace App\Http\Middleware\Feature;

use App\Features\AadharEmailUpdateFeature;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AadharEmailUpdateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!AadharEmailUpdateFeature::isFeatureAvailableForUser()) {
            abort(404);
        }
        return $next($request);
    }
}
