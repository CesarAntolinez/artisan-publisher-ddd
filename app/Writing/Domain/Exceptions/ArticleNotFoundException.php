<?php

namespace Writing\Domain\Exceptions;

use Exception;

class ArticleNotFoundException extends Exception
{
    /**
     * "Named constructor" para crear la excepción con un mensaje claro.
     */
    public static function withId(string $id): self
    {
        return new self("Article with ID <{$id}> was not found.");
    }
}
