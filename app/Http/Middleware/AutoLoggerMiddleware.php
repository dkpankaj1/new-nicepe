<?php

namespace App\Http\Middleware;

use App\Helpers\ActivityLogger;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutoLoggerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->method() !== 'GET') { // Log only non-GET requests
            ActivityLogger::log(
                action: 'request',
                module: 'HTTP',
                description: 'Request made to ' . $request->path(),
                requestData: $request->all()
            );
        }
        
        return $next($request);
    }
}
