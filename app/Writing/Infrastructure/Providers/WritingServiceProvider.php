<?php

namespace Writing\Infrastructure\Providers;

use Writing\Domain\Repositories\ArticleRepository;
use Illuminate\Support\ServiceProvider;
use Writing\Infrastructure\Persistence\Eloquent\EloquentArticleRepository;

class WritingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            ArticleRepository::class,
            EloquentArticleRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
