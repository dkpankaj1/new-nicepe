<?php

namespace App\Http\Middleware\Retailer;

use App\Features\AadharEmailUpdateFeature;
use App\Services\ToasterService;
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
        // feature is enable or not
        if (!AadharEmailUpdateFeature::isEnabled()) {
            abort(404, 'Feature is not enabled');
        }
        // // feature is available for this retailer or not
        if (!AadharEmailUpdateFeature::isEnableForUser()) {
            ToasterService::info('Feature is not available for you');
            return redirect()->route('retailer.myplan.index');
        }

        // // feature is active or not
        if (!AadharEmailUpdateFeature::isActiveForUser()) {
            ToasterService::info('Feature is not Active. Please activate it first');
            return redirect()->route('retailer.myplan.index');
        }

        return $next($request);
    }
}
