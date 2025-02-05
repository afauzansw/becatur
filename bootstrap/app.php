<?php

use App\Http\Middleware\AdminAuthMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            $load_routes = function ($directory, $middleware, $prefix, $as) {
                $iterator = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($directory, RecursiveDirectoryIterator::SKIP_DOTS)
                );

                foreach ($iterator as $file) {
                    if ($file->isFile() && $file->getExtension() === 'php') {
                        Route::middleware($middleware)
                            ->prefix($prefix)
                            ->as($as . ".")
                            ->group($file->getPathname());
                    }
                }
            };

            $load_routes(base_path('routes/api'), 'api', 'api', 'api');
            $load_routes(base_path('routes/web'), 'web', '', 'web');
        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            "auth.admin" => AdminAuthMiddleware::class,
        ]);

        $middleware->web(append: [
            \App\Http\Middleware\HandleInertiaRequests::class,
            \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
