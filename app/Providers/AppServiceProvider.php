<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\SectionRepositoryInterface;
use App\Repositories\SectionRepository;
use App\Interfaces\CasesRepositoryInterface;
use App\Repositories\CasesRepository;
use App\Interfaces\LocaleRepositoryInterface;
use App\Repositories\LocaleRepository;
use App\Interfaces\ContentRepositoryInterface;
use App\Repositories\ContentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(CasesRepositoryInterface::class, CasesRepository::class);
        $this->app->bind(LocaleRepositoryInterface::class, LocaleRepository::class);
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
