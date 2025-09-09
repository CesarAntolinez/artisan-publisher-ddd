<?php

namespace Writing\Application\UseCases;

use Writing\Domain\Repositories\ArticleRepository;
use Writing\Application\DTOs\ArticleDTO;
use Writing\Domain\Exceptions\ArticleNotFoundException;

class ArticleFinder
{
    public function __construct(private readonly ArticleRepository $repository)
    {
    }

    public function __invoke(string $articleId): ArticleDTO
    {
        $article = $this->repository->findById($articleId);

        if ($article === null) {
            throw ArticleNotFoundException::withId("Article with ID {$articleId} not found.");
        }

        return ArticleDTO::fromEntity($article);
    }
}
