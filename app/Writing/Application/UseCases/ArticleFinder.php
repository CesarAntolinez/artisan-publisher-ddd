<?php

namespace Writing\Application\UseCases;

use Writing\Application\DTOs\ArticleDTO;
use Writing\Domain\ArticleRepository;
use Exception;

class ArticleFinder
{
    public function __construct(private readonly ArticleRepository $repository)
    {
    }

    public function __invoke(string $articleId): ArticleDTO
    {
        $article = $this->repository->findById($articleId);

        if ($article === null) {
            throw new Exception("Article with ID {$articleId} not found.");
        }

        return ArticleDTO::fromEntity($article);
    }
}
