<?php

use Illuminate\Foundation\{Application, Configuration\Exceptions, Configuration\Middleware};
use Illuminate\Http\Request;
use Writing\Domain\Exceptions\{ArticleNotFoundException, CannotCommentOnArticleException};

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Aquí registramos nuestro manejador personalizado
        $exceptions->renderable(function (ArticleNotFoundException|CannotCommentOnArticleException $e, Request $request) {
            // Verificamos si la petición espera una respuesta JSON
            if ($request->wantsJson()) {
                return response()->json(
                    ['message' => $e->getMessage(), 'code' => $e->getCode()],
                    \Illuminate\Http\Response::HTTP_NOT_FOUND // Código 404
                );
            }
        });
    })->create();
