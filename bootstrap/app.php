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
        $middleware->alias([
            'user-role' =>  \App\Http\Middleware\RoleMiddleware::class,
            'log-viewer-role' => \App\Http\Middleware\LogViewerAuth::class,
            'loguseractivity' => \App\Http\Middleware\LogUserActivity::class,
            'autologout' => \App\Http\Middleware\AutoLogout::class,            
        ]);
        $middleware->web(append: [
        ]);
    })
    
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();