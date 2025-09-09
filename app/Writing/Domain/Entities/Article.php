<?php

namespace Writing\Domain\Entities;

use Illuminate\Support\Str;
use Writing\Domain\Events\ArticleWasProposedForReview;
use Writing\Domain\Exceptions\CannotCommentOnArticleException;
use Writing\Domain\Support\RecordsDomainEvents;

class Article
{
    use RecordsDomainEvents; // <-- Usa el trait

    private string $id;
    private string $authorId;
    private string $title;
    private string $content;
    private string $status;

    /** @var Comment[] */
    private array $comments = []; // <-- Propiedad para mantener los comentarios en memoria

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

    /**
     * Este es el método de nuestro Agregado. Es el único punto de entrada
     * para añadir un comentario.
     */
    public function addComment(string $author, string $text): void
    {
        // 1. APLICAR LA REGLA DE NEGOCIO (INVARIANTE)
        if ($this->status !== self::STATUS_IN_REVIEW) {
            throw CannotCommentOnArticleException::becauseStatusIs($this->status);
        }

        // 2. Si la regla se cumple, crear y añadir el comentario
        $this->comments[] = new Comment(
            id: Str::uuid()->toString(), // La raíz del agregado es responsable de crear el ID
            articleId: $this->id,
            author: $author,
            text: $text
        );

        // Opcional: Podríamos registrar un evento de dominio 'CommentWasAdded' aquí.
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

    /**
     * Getter para que el repositorio pueda acceder a los comentarios y persistirlos.
     * @return Comment[]
     */
    public function comments(): array
    {
        return $this->comments;
    }

    /**
     * Método para que el repositorio pueda "rehidratar" la entidad con sus comentarios.
     * @param Comment[] $comments
     */
    public function setComments(array $comments): void
    {
        $this->comments = $comments;
    }
}
