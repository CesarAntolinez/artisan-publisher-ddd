<?php

namespace Writing\Domain\Repositories;

// Usamos un 'use' para importar nuestra entidad y que el código sea más limpio.
use Writing\Domain\Entities\Article;

interface ArticleRepository
{
    /**
     * Busca un artículo por su ID.
     * Puede devolver un Artículo o null si no lo encuentra.
     */
    public function findById(string $id): ?Article;

    /**
     * Guarda un artículo (ya sea nuevo o una actualización).
     */
    public function save(Article $article): void;
}
