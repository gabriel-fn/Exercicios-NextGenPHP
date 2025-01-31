<?php

namespace App\Providers;

use Architecture\Application\Domain\Mapper\GenericObjectMapperInterface;
use Architecture\Application\Domain\Repository\ReservationRepositoryInterface;
use Architecture\Application\Domain\Repository\StoredBookRepositoryInterface;
use Architecture\Application\Domain\Repository\UserRepositoryInterface;
use Architecture\Application\UseCase\CreateReservationUseCase;
use Architecture\Application\UseCase\FindReservationByIdUseCase;
use Architecture\Application\UseCase\FindStoredBookByIdUseCase;
use Architecture\Application\UseCase\FindUserByIdUseCase;
use Architecture\Application\UseCase\RegisterReturnReservationUseCase;
use Architecture\Application\UseCase\UpdateReservationUseCase;
use Architecture\Infrastructure\Mapper\ObjectMapper;
use Architecture\Infrastructure\Repository\ReservationRepository;
use Architecture\Infrastructure\Repository\StoredBookRepository;
use Architecture\Infrastructure\Repository\UserRepository;
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

        $this->app->bind(UserRepositoryInterface::class, function ($app) {
            return new UserRepository(
                $app->make(GenericObjectMapperInterface::class)
            );
        });

        $this->app->bind(StoredBookRepositoryInterface::class, function ($app) {
            return new StoredBookRepository(
                $app->make(GenericObjectMapperInterface::class)
            );
        });

        $this->app->bind(FindReservationByIdUseCase::class, function ($app) {
            return new FindReservationByIdUseCase(
                $app->make(ReservationRepositoryInterface::class)
            );        
        });

        $this->app->bind(CreateReservationUseCase::class, function ($app) {
            return new CreateReservationUseCase(
                $app->make(ReservationRepositoryInterface::class)
            );        
        });

        $this->app->bind(UpdateReservationUseCase::class, function ($app) {
            return new UpdateReservationUseCase(
                $app->make(ReservationRepositoryInterface::class)
            );        
        });

        $this->app->bind(RegisterReturnReservationUseCase::class, function ($app) {
            return new RegisterReturnReservationUseCase(
                $app->make(FindReservationByIdUseCase::class),
                $app->make(UpdateReservationUseCase::class)
            );        
        });

        $this->app->bind(FindUserByIdUseCase::class, function ($app) {
            return new FindUserByIdUseCase(
                $app->make(UserRepositoryInterface::class)
            );        
        });

        $this->app->bind(FindStoredBookByIdUseCase::class, function ($app) {
            return new FindStoredBookByIdUseCase(
                $app->make(StoredBookRepositoryInterface::class)
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
