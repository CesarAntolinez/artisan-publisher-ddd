<?php

namespace Writing\Infrastructure\Persistence\Eloquent;

use Writing\Domain\Article;
use Writing\Domain\ArticleRepository;
class EloquentArticleRepository implements ArticleRepository
{

    public function findById(string $id): ?Article
    {

        $articleModel = ArticleModel::find($id);

        if ($articleModel === null) {
            return null;
        }

        // "Rehidratamos" la Entidad de Dominio a partir del Modelo de Eloquent
        return $this->toDomainEntity($articleModel);
    }

    public function save(Article $article): void
    {
        // Buscamos si ya existe o creamos una nueva instancia
        $articleModel = ArticleModel::findOrNew($article->id());

        // "Mapeamos" los datos desde la Entidad de Dominio al Modelo de Eloquent
        $articleModel->id = $article->id();
        $articleModel->author_id = $article->authorId();
        $articleModel->title = $article->title();
        $articleModel->content = $article->content();
        $articleModel->status = $article->status();

        $articleModel->save();
    }

    private function toDomainEntity(ArticleModel $articleModel): Article
    {
        // ¡OJO! Aquí estamos usando reflexión para crear la entidad sin llamar al constructor,
        // porque la entidad ya existe y no queremos aplicar las reglas de negocio de creación (ej: status = 'draft').
        $reflectionClass = new \ReflectionClass(Article::class);
        $article = $reflectionClass->newInstanceWithoutConstructor();

        $this->setPrivateProperty($article, 'id', $articleModel->id);
        $this->setPrivateProperty($article, 'authorId', $articleModel->author_id);
        $this->setPrivateProperty($article, 'title', $articleModel->title);
        $this->setPrivateProperty($article, 'content', $articleModel->content);
        $this->setPrivateProperty($article, 'status', $articleModel->status);

        return $article;
    }

    private function setPrivateProperty(object $object, string $property, mixed $value): void
    {
        $reflectionProperty = new \ReflectionProperty($object, $property);
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($object, $value);
    }

}
