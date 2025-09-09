<?php

namespace Writing\Domain\Exceptions;

use Exception;

class CannotCommentOnArticleException extends Exception
{
    public static function becauseStatusIs(string $status): self
    {
        return new self("Cannot add a comment to an article with status <{$status}>.");
    }
}
