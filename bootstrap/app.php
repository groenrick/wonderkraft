<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        // Add the site scoping middleware
        $middleware->alias([
            'resolve.domain' => \App\Http\Middleware\ResolveCustomerDomain::class,

            // Add the site scoping middleware
            'scope.admin.site' => \App\Http\Middleware\ScopeAdminToSite::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
