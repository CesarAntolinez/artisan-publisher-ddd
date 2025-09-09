<?php

namespace Writing\Domain\Events;

// Nota: Nombramos los eventos en tiempo pasado porque representan algo que ya ocurrió.
class ArticleWasProposedForReview
{
    public function __construct(
        public readonly string $articleId,
        public readonly string $authorId
    ) {
    }
}
