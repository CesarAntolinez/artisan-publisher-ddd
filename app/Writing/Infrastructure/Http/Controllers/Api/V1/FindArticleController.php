<?php

namespace Writing\Infrastructure\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Writing\Application\UseCases\ArticleFinder;

class FindArticleController extends Controller
{
    public function __construct(private readonly ArticleFinder $finder)
    {
    }

    public function __invoke(string $articleId): JsonResponse
    {
        try {
            $articleDTO = ($this->finder)($articleId);
            // Laravel convertirá automáticamente el DTO público a JSON.
            return response()->json($articleDTO);
        } catch (\Exception $e) {
            // En una app real, tendrías un manejo de excepciones centralizado.
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
