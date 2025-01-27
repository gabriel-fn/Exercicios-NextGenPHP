<?php

namespace App\Providers;

use Architecture\Application\Domain\Mapper\GenericObjectMapperInterface;
use Architecture\Application\Domain\Repository\ReservationRepositoryInterface;
use Architecture\Infrastructure\Mapper\ObjectMapper;
use Architecture\Infrastructure\Repository\ReservationRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(GenericObjectMapperInterface::class, function ($app) {
            return new ObjectMapper();
        });

        $this->app->bind(ReservationRepositoryInterface::class, function ($app) {
            return new ReservationRepository(
                $app->make(GenericObjectMapperInterface::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
