<?php

namespace Writing\Domain\Entities;

class Comment
{
    private string $id;
    private string $articleId;
    private string $author;
    private string $text;

    public function __construct(string $id, string $articleId, string $author, string $text)
    {
        // En un caso real, aquí podrías añadir validaciones.
        // Por ejemplo, que el texto del comentario no esté vacío.
        $this->id = $id;
        $this->articleId = $articleId;
        $this->author = $author;
        $this->text = $text;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function articleId(): string
    {
        return $this->articleId;
    }

    public function author(): string
    {
        return $this->author;
    }

    public function text(): string
    {
        return $this->text;
    }
}
