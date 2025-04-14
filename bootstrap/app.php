<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\PreventBackHistory;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Filesystem\FilesystemServiceProvider;
use App\Providers\FirebaseServiceProvider; // ✅ Import your provider

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register your middleware here
        // $middleware->append(\App\Http\Middleware\FirebaseSessionMiddleware::class);
        $middleware->prepend(middleware: PreventBackHistory::class,);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withProviders([
        FilesystemServiceProvider::class,  // ✅ Filesystem provider
        FirebaseServiceProvider::class,    // ✅ Register your Firebase provider
    ])
    ->create();

