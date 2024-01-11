<?php

namespace App\Providers;

use App\Repositories\Interfaces\LanguageRepositoryInterface;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\PostTranslationRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\Interfaces\TagTranslationRepositoryInterface;
use App\Repositories\LanguageRepository;
use App\Repositories\PostRepository;
use App\Repositories\PostTranslationRepository;
use App\Repositories\TagRepository;
use App\Repositories\TagTranslationRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            PostRepositoryInterface::class,
            PostRepository::class
        );
        $this->app->bind(
            PostTranslationRepositoryInterface::class,
            PostTranslationRepository::class
        );
        $this->app->bind(
            TagRepositoryInterface::class,
            TagRepository::class
        );
        $this->app->bind(
            TagTranslationRepositoryInterface::class,
            TagTranslationRepository::class
        );
        $this->app->bind(
            LanguageRepositoryInterface::class,
            LanguageRepository::class
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
