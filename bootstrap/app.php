<?php

use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\ApiClientAccess;
use App\Http\Middleware\DistributorAccess;
use App\Http\Middleware\RetailerAccess;
use App\Http\Middleware\SuperDistributorAccess;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            __DIR__ . '/../routes/web.php',
            __DIR__ . '/../routes/api-client.php',
            __DIR__ . '/../routes/super-distributor.php',
            __DIR__ . '/../routes/distributor.php',
            __DIR__ . '/../routes/retailer.php',
            __DIR__ . '/../routes/admin.php',
        ],
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(
            [
                'admin' => AdminAccess::class,
                'apiclinet' => ApiClientAccess::class,
                'superdistributor' => SuperDistributorAccess::class,
                'distributor' => DistributorAccess::class,
                'retailer' => RetailerAccess::class
            ],
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
