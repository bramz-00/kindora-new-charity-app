<?php

use App\Exceptions\CustomExceptionHandlers;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->priority([
            StartSession::class,
            ShareErrorsFromSession::class,
            ThrottleRequests::class,
            SubstituteBindings::class,
        ]);
        $middleware->statefulApi();
        $middleware->validateCsrfTokens(['/api/*']);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        CustomExceptionHandlers::register($exceptions);
    })->create();
