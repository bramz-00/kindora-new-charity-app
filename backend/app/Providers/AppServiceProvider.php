<?php

namespace App\Providers;

use App\Repositories\Good\GoodRepository;
use App\Repositories\Good\GoodRepositoryInterface;
use App\Repositories\Organisation\OrganisationRepository;
use App\Repositories\Organisation\OrganisationRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(OrganisationRepositoryInterface::class, OrganisationRepository::class);
        $this->app->bind(GoodRepositoryInterface::class, GoodRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
