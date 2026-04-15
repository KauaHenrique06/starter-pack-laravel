<?php

use App\Support\ApiResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api/index.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function(Throwable $e) {

            if($e instanceof AuthenticationException) {
                return ApiResponse::error(
                    'Your credentials are invalid!',
                    401
                );
            }

            if($e instanceof AuthorizationException) {
                return ApiResponse::error(
                    "You don't have permission for this action!",
                    403
                );
            }

            if($e instanceof ModelNotFoundException || $e instanceof NotFoundHttpException) {
                return ApiResponse::error(
                    "Resources not found!",
                    404
                );
            }

            if($e instanceof ValidationException) {
                return ApiResponse::error(
                    $e->getMessage(),
                    422
                );
            }

            if($e instanceof MethodNotAllowedHttpException) {
                return ApiResponse::error(
                    'This method is invalid!',
                    405
                );
            }

            if($e instanceof Throwable || $e instanceof Exception) {
                return ApiResponse::error(
                    "Server internal error!",
                    500
                );
            }
        });
    })->create();

