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
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Interfaces\RolRepositoryInterface;
use App\Repositories\RolRepository;
use App\Interfaces\MenuRepositoryInterface;
use App\Repositories\MenuRepository;
use App\Interfaces\FAQRepositoryInterface;
use App\Repositories\FAQRepository;

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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(RolRepositoryInterface::class, RolRepository::class);
        $this->app->bind(MenuRepositoryInterface::class, MenuRepository::class);
        $this->app->bind(FAQRepositoryInterface::class, FAQRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
