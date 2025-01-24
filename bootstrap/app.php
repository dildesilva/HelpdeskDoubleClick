<?php

use App\Http\Middleware\AdminGrp;
use App\Http\Middleware\EngitGrp;
use App\Http\Middleware\UserGrp;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => AdminGrp::class,
            'user' => UserGrp::class,
            'itEng' => EngitGrp::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
    })->create();
