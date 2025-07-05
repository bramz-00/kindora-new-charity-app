<?php

namespace App\Providers;

use App\Repositories\Event\EventRepository;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\Good\GoodRepository;
use App\Repositories\Good\GoodRepositoryInterface;
use App\Repositories\Jackpot\JackpotRepository;
use App\Repositories\Jackpot\JackpotRepositoryInterface;
use App\Repositories\Organisation\OrganisationRepository;
use App\Repositories\Organisation\OrganisationRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\VolunteerOpportunity\VolunteerOpportunityRepository;
use App\Repositories\VolunteerOpportunity\VolunteerOpportunityRepositoryInterface;
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
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(JackpotRepositoryInterface::class, JackpotRepository::class);
        $this->app->bind(VolunteerOpportunityRepositoryInterface::class, VolunteerOpportunityRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
