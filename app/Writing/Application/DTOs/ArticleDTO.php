<?php

namespace Writing\Application\DTOs;

use Writing\Domain\Article;

class ArticleDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $authorId,
        public readonly string $title,
        public readonly string $content,
        public readonly string $status
    ) {
    }

    public static function fromEntity(Article $article): self
    {
        return new self(
            id: $article->id(),
            authorId: $article->authorId(),
            title: $article->title(),
            content: $article->content(),
            status: $article->status()
        );
    }
}
