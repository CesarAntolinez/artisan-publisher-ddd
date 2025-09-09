<?php

namespace Writing\Infrastructure\Http\Controllers\Api\V1;

use Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Writing\Application\UseCases\ListArticles\ArticleListFinder;

class ListArticlesController extends Controller
{
    public function __construct(private readonly ArticleListFinder $finder)
    {
    }

    public function __invoke(): JsonResponse
    {
        // El finder nos devuelve una colección de DTOs.
        $articleDTOs = ($this->finder)();

        // Laravel la convertirá en un array de objetos JSON.
        return response()->json($articleDTOs);
    }
}
