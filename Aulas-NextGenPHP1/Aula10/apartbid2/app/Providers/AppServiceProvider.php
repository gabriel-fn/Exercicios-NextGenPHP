<?php

namespace App\Providers;

use Architecture\Application\UseCase\Aparment\GetApartmentByIdUseCase;
use Architecture\Application\UseCase\RentalBid\CreateRentalBidUseCase;
use Architecture\Controller\RentalBidController;
use Architecture\Infrastructure\Repository\Eloquent\EloquentRepositoryStrategy;
use Architecture\Infrastructure\Repository\GenericRepository;
use Architecture\Presenter\ApiPresenter;
use Architecture\Presenter\Interface\PresenterInterface;
use Architecture\Presenter\JsonPresenterStrategy;
use Illuminate\Support\ServiceProvider;
use Laminas\Hydrator\HydratorInterface;
use Laminas\Hydrator\NamingStrategy\UnderscoreNamingStrategy;
use Laminas\Hydrator\ObjectPropertyHydrator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PresenterInterface::class, function () {
            return new ApiPresenter(new JsonPresenterStrategy());
        });

        $this->app->bind(HydratorInterface::class, function () {
            $hydrator = new ObjectPropertyHydrator();
            $hydrator->setNamingStrategy(new UnderscoreNamingStrategy());
            return $hydrator;
        });

        $this->app->bind(GenericRepository::class, function ($app) {
            return new GenericRepository(
                new EloquentRepositoryStrategy($app->get(HydratorInterface::class))
            );
        });

        $this->app->bind(GetApartmentByIdUseCase::class, function ($app) {
            return new GetApartmentByIdUseCase($app->get(GenericRepository::class));
        });

        $this->app->bind(CreateRentalBidUseCase::class, function ($app) {
            return new CreateRentalBidUseCase(
                $app->get(GenericRepository::class),
                $app->get(HydratorInterface::class),
                $app->get(GetApartmentByIdUseCase::class),
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
