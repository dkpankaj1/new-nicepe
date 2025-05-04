<?php

namespace App\Http\Middleware\Retailer;

use App\Features\AadharMobileEmailUpdateFeature;
use App\Services\ToasterService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AadharMobileEmailUpdateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // feature is enable or not
        if (!AadharMobileEmailUpdateFeature::isEnabled()) {
            abort(404, 'Feature is not enabled');
        }
        // feature is available for this retailer or not
        if (!AadharMobileEmailUpdateFeature::isEnableForUser()) {
            ToasterService::info('Feature is not available for you');
            return redirect()->route('retailer.myplan.index');
        }
        // feature is active or not
        if (!AadharMobileEmailUpdateFeature::isActiveForUser()) {
            ToasterService::info('Feature is not Active. Please activate it first');
            return redirect()->route('retailer.myplan.index');
        }
        // has sufficient balance or not
        if (!$request->user()->hasSufficientBalance(AadharMobileEmailUpdateFeature::getFeatureDetail())) {
            ToasterService::error('You do not have sufficient balance.Please recharge your wallet.');
            return redirect()->route('retailer.wallet-recharge.create');
        }
        return $next($request);
    }
}
