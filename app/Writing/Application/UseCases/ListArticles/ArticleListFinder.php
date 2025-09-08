<?php

namespace Writing\Application\UseCases\ListArticles;

use Illuminate\Support\Collection;
use Writing\Application\DTOs\ArticleDTO;
use Writing\Infrastructure\Persistence\Eloquent\ArticleModel;
class ArticleListFinder
{
    /**
     * Este Finder no depende del Repositorio de Dominio,
     * sino directamente del modelo de Eloquent para optimizar la consulta.
     */
    public function __invoke(): Collection
    {
        // 1. Hacemos una consulta directa y eficiente con Eloquent.
        // Podríamos añadir paginación, filtros, ordenación, etc.
        $articleModels = ArticleModel::query()
            ->select('id', 'author_id', 'title', 'content', 'status')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        // 2. Mapeamos la colección de modelos de Eloquent a una colección de DTOs.
        return $articleModels->map(function (ArticleModel $model) {
            return new ArticleDTO(
                id: $model->id,
                authorId: $model->author_id,
                title: $model->title,
                content: $model->content,
                status: $model->status
            );
        });
    }
}
