<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\SectionRepositoryInterface;
use App\Repositories\SectionRepository;
use App\Interfaces\CasesRepositoryInterface;
use App\Repositories\CasesRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
        $this->app->bind(CasesRepositoryInterface::class, CasesRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
