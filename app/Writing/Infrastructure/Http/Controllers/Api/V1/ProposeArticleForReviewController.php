<?php

namespace Writing\Infrastructure\Http\Controllers\Api\V1;

use Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Writing\Application\UseCases\ProposeArticleForReviewHandler;

class ProposeArticleForReviewController extends Controller
{
    public function __construct(private readonly ProposeArticleForReviewHandler $handler)
    {
    }

    // Usamos el 'Route Model Binding' implícito de Laravel para obtener el ID.
    public function __invoke(string $articleId): JsonResponse
    {
        // En un caso real, aquí verificarías con un Policy que el usuario
        // tiene permiso para realizar esta acción sobre este artículo.

        $this->handler->handle($articleId);

        return response()->json(['message' => 'Article proposed for review successfully.']);
    }

}
