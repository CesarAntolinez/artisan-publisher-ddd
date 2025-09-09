<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Log;
use Writing\Domain\Events\ArticleWasProposedForReview;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReviewNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ArticleWasProposedForReview $event): void
    {

        // Aquí iría tu lógica real para enviar un email, una notificación push, etc.
        // Por ahora, solo escribiremos en el log para probar que funciona.
        Log::info(
            "EDITOR NOTIFICATION: Article {$event->articleId} from author {$event->authorId} is ready for review."
        );
    }
}
