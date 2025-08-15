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
use App\Interfaces\SubmenuRepositoryInterface;
use App\Repositories\SubmenuRepository;
use App\Interfaces\LogRepositoryInterface;
use App\Repositories\LogRepository;
use App\Interfaces\Content_FAQRepositoryInterface;
use App\Repositories\Content_FAQRepository;
use App\Interfaces\ContentCarrouselRepositoryInterface;
use App\Repositories\ContentCarrouselRepository;
use App\Interfaces\CarrouselRepositoryInterface;
use App\Repositories\CarrouselRepository;

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
        $this->app->bind(SubmenuRepositoryInterface::class, SubmenuRepository::class);
        $this->app->bind(LogRepositoryInterface::class, LogRepository::class);
        $this->app->bind(Content_FAQRepositoryInterface::class, Content_FAQRepository::class);
        $this->app->bind(ContentCarrouselRepositoryInterface::class, ContentCarrouselRepository::class);
        $this->app->bind(CarrouselRepositoryInterface::class, CarrouselRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
