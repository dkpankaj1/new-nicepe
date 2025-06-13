<?php

namespace App\Http\Middleware\Distributor;

use App\Services\ToasterService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EkycCompleteMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $user = Auth::user();

        if ($user && $user->ekyc === 1) {
            ToasterService::success('Your ekyc is already completed.');
            return redirect()->route('distributor.dashboard');
        }

        return $next($request);
    }
}
