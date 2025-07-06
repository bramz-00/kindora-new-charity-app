<?php

namespace App\Providers;

use App\Repositories\Event\EventRepository;
use App\Repositories\Event\EventRepositoryInterface;
use App\Repositories\EventOrder\EventOrderRepository;
use App\Repositories\EventOrder\EventOrderRepositoryInterface;
use App\Repositories\EventTicket\EventTicketRepository;
use App\Repositories\EventTicket\EventTicketRepositoryInterface;
use App\Repositories\Good\GoodRepository;
use App\Repositories\Good\GoodRepositoryInterface;
use App\Repositories\Jackpot\JackpotRepository;
use App\Repositories\Jackpot\JackpotRepositoryInterface;
use App\Repositories\JackpotContribution\JackpotContributionRepository;
use App\Repositories\JackpotContribution\JackpotContributionRepositoryInterface;
use App\Repositories\Organisation\OrganisationRepository;
use App\Repositories\Organisation\OrganisationRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use App\Repositories\VolunteerApplication\VolunteerApplicationRepository;
use App\Repositories\VolunteerApplication\VolunteerApplicationRepositoryInterface;
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
        $this->app->bind(EventOrderRepositoryInterface::class, EventOrderRepository::class);
        $this->app->bind(EventTicketRepositoryInterface::class, EventTicketRepository::class);
        $this->app->bind(JackpotRepositoryInterface::class, JackpotRepository::class);
        $this->app->bind(JackpotContributionRepositoryInterface::class, JackpotContributionRepository::class);
        $this->app->bind(VolunteerOpportunityRepositoryInterface::class, VolunteerOpportunityRepository::class);
        $this->app->bind(VolunteerApplicationRepositoryInterface::class, VolunteerApplicationRepository::class);

  
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
