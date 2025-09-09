<?php

namespace Writing\Application\UseCases\AddComment;

use Writing\Domain\Exceptions\ArticleNotFoundException;
use Writing\Domain\Repositories\ArticleRepository;

class AddCommentHandler
{
    public function __construct(private readonly ArticleRepository $repository)
    {
    }

    public function handle(string $articleId, string $author, string $text): void
    {
        // 1. Cargamos el agregado completo desde el repositorio.
        $article = $this->repository->findById($articleId);

        if ($article === null) {
            throw ArticleNotFoundException::withId($articleId);
        }

        // 2. Ejecutamos el método de comportamiento en la raíz del agregado.
        // Toda la lógica y las reglas de negocio están aquí dentro.
        $article->addComment($author, $text);

        // 3. Persistimos el agregado completo. El repositorio se encargará
        // de guardar tanto el artículo como sus nuevos comentarios.
        $this->repository->save($article);
    }
}
