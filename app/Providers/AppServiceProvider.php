<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\SectionRepositoryInterface;
use App\Repositories\SectionRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SectionRepositoryInterface::class, SectionRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
