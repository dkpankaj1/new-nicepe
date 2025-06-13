<?php

namespace App\Http\Middleware;

use App\Features\AadharMobileEmailUpdateFeature;
use App\Features\MobileRechargeFeature;
use App\Features\NsdlPanApplicationFeature;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FeatureActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $featureCode): Response
    {
        $features = [
            'FTR001' => fn() => MobileRechargeFeature::isActiveForUser(),
            'FTR002' => fn() => NsdlPanApplicationFeature::isActiveForUser(),
            'FTR003' => fn() => AadharMobileEmailUpdateFeature::isActiveForUser(),
        ];

        if (!$features[$featureCode]()) {
            abort(404);
        }

        return $next($request);
    }
}
