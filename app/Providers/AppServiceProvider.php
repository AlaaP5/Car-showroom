<?php

namespace App\Providers;


use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\BookingRepositoryInterface;
use App\Interfaces\DestinationRepositoryInterface;
use App\Interfaces\TripRepositoryInterface;
use App\Repositories\AuthRepository;
use App\Repositories\BookingRepository;
use App\Repositories\DestinationRepository;
use App\Repositories\TripRepository;

;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(TripRepositoryInterface::class, TripRepository::class);
        $this->app->bind(DestinationRepositoryInterface::class, DestinationRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
