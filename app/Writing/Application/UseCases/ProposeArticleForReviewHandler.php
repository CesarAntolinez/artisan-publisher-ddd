<?php

namespace Writing\Application\UseCases;

use Writing\Domain\ArticleRepository;
// En el futuro, podríamos crear excepciones de dominio personalizadas.
use Exception;

class ProposeArticleForReviewHandler
{
    public function __construct(private readonly ArticleRepository $repository)
    {
    }

    public function handle(string $articleId): void
    {
        // 1. Usamos el repositorio para encontrar y "rehidratar" nuestra entidad.
        $article = $this->repository->findById($articleId);

        // 2. Verificamos que el artículo exista.
        if ($article === null) {
            // En una aplicación real, lanzaríamos una excepción más específica
            // como ArticleNotFoundException.
            throw new Exception("Article with ID {$articleId} not found.");
        }

        // 3. ¡La magia del Dominio! Llamamos al método que contiene la lógica de negocio.
        $article->proposeToReview();

        // 4. Guardamos el estado actualizado de la entidad en la base de datos.
        $this->repository->save($article);
    }
}
