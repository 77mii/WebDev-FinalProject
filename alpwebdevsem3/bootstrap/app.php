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
        // Add an array of middleware
        $middleware->use([
            
       //  \App\Http\Middleware\UserDataMiddleware::class, // New combined middleware
     //\App\Http\Middleware\StudentData::class, // Existing middleware
 //  \App\Http\Middleware\AdminMiddleware::class, // Add this line to check admin authentication
  //     \App\Http\Middleware\LecturerData::class, // Lecturer middleware
            // \App\Http\Middleware\StudentData::class, // Your custom middleware
        ]);

        $middleware->alias([
         //   'studentdata' => \App\Http\Middleware\StudentData::class,
          //  'lecturerdata' => \App\Http\Middleware\LecturerData::class,
            // 'userdata' => \App\Http\Middleware\UserDataMiddleware::class,
            // 'role' => \App\Http\Middleware\RoleMiddleware::class, // Role-based middleware
            'auth.student' => \App\Http\Middleware\RedirectIfNotStudent::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
