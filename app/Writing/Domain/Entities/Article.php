<?php

namespace Writing\Domain\Entities;

use Writing\Domain\Events\ArticleWasProposedForReview;
use Writing\Domain\Support\RecordsDomainEvents;

class Article
{
    use RecordsDomainEvents; // <-- Usa el trait

    private string $id;
    private string $authorId;
    private string $title;
    private string $content;
    private string $status;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_IN_REVIEW = 'in_review';

    public function __construct(string $id, string $authorId, string $title, string $content)
    {
        $this->id = $id;
        $this->authorId = $authorId;
        $this->title = $title;
        $this->content = $content;
        $this->status = self::STATUS_DRAFT; // Un artículo siempre empieza como borrador
    }

    public function proposeToReview(): void
    {
        if (empty($this->title) || empty($this->content)) {
            // En un futuro, aquí lanzaríamos una excepción de dominio.
            // Por ahora, lo dejamos simple.
            return;
        }

        $this->status = self::STATUS_IN_REVIEW;

        // ¡Aquí está la magia! Registramos el evento.
        $this->recordDomainEvent(
            new ArticleWasProposedForReview($this->id, $this->authorId)
        );
    }

    // --- Getters para acceder a las propiedades privadas ---

    public function id(): string
    {
        return $this->id;
    }

    public function authorId(): string
    {
        return $this->authorId;
    }

    public function title(): string
    {
        return $this->title;
    }

    public function content(): string
    {
        return $this->content;
    }

    public function status(): string
    {
        return $this->status;
    }
}
