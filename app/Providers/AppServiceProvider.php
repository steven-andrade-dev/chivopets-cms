<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\SectionRepositoryInterface;
use App\Repositories\SectionRepository;
use App\Interfaces\CasesRepositoryInterface;
use App\Repositories\CasesRepository;
use App\Interfaces\ContentRepositoryInterface;
use App\Repositories\ContentRepository;
use App\Interfaces\MainRepositoryInterface;
use App\Repositories\MainRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(CasesRepositoryInterface::class, CasesRepository::class);
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
        $this->app->bind(MainRepositoryInterface::class, MainRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
