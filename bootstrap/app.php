<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register the 'admin' alias as middleware
        $middleware->alias([
            'admin' => App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {


        // 🚫 404 - Page not found
        $exceptions->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 404,
                    'message' => 'Page not found',
                ], 404);
            }

            return response()->view('errors.404', [], 404);
        });

        // 🚫 403 - Forbidden
        $exceptions->renderable(function (AccessDeniedHttpException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 403,
                    'message' => 'Forbidden',
                ], 403);
            }

            return response()->view('errors.403', [], 403);
        });

        // 🔐 401 - Not authenticated
        $exceptions->renderable(function (AuthenticationException $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 401,
                    'message' => 'Unauthenticated',
                ], 401);
            }

            return redirect()->route('login');
        });

        // 💥 500 - Generic server error
        $exceptions->renderable(function (\Throwable $e, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => 500,
                    'message' => 'Server error',
                ], 500);
            }

            return response()->view('errors.500', [], 500);
    });
    
    })->create();
