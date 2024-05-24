<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        api: __DIR__.'/../routes/api.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render( function ( \Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
            throw new \App\Exceptions\NotFoundException();
        });
        $exceptions->render( function ( \Illuminate\Auth\AuthenticationException $e) {
            throw new \App\Exceptions\UnauthenticatedUserException();
        });
        $exceptions->render( function ( \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException $e) {
            throw new \App\Exceptions\AccessDeniedException();
        });
    })->create();
