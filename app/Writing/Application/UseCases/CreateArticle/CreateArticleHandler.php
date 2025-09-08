<?php

namespace Writing\Application\UseCases\CreateArticle;

use Illuminate\Support\Str;
use Writing\Domain\Article;
use Writing\Domain\ArticleRepository;

class CreateArticleHandler
{
// Inyectamos la INTERFAZ, no la implementación.
    // Gracias al ServiceProvider, Laravel sabrá qué clase concreta pasarle aquí.
    public function __construct(private readonly ArticleRepository $repository)
    {
    }

    public function handle(string $authorId, string $title, string $content): void
    {
        // 1. Generamos un nuevo ID para nuestro artículo.
        $articleId = Str::uuid()->toString();

        // 2. Usamos el constructor de nuestra Entidad de Dominio para crear el objeto.
        // Aquí se aplican las reglas de negocio (eje: el estado inicial es 'draft').
        $article = new Article(
            id: $articleId,
            authorId: $authorId,
            title: $title,
            content: $content
        );

        // 3. Usamos el repositorio para persistir la nueva entidad.
        $this->repository->save($article);

        // En casos de uso más complejos, aquí podrías devolver el ID del artículo,
        // despachar un evento de dominio, etc. Por ahora lo mantenemos simple.
    }
}
