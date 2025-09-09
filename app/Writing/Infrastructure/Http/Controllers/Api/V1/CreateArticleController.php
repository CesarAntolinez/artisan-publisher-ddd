<?php

namespace Writing\Infrastructure\Http\Controllers\Api\V1;

use Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Writing\Application\UseCases\CreateArticle\CreateArticleHandler;
use Writing\Infrastructure\Http\Requests\Api\V1\CreateArticleRequest;

class CreateArticleController extends Controller
{
    public function __construct(private readonly CreateArticleHandler $handler)
    {
    }

    public function __invoke(CreateArticleRequest $request): JsonResponse
    {
        // ¡La validación ya ocurrió! Laravel lo hizo por nosotros automáticamente.
        // Ahora solo obtenemos los datos ya validados.
        $validatedData = $request->validated();

        $this->handler->handle(
            $validatedData['author_id'],
            $validatedData['title'],
            $validatedData['content']
        );

        return response()->json(['message' => 'Article created successfully.'], 201);
    }
}
