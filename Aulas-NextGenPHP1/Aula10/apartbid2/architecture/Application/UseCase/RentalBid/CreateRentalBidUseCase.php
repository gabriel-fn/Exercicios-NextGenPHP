<?php

namespace Architecture\Application\UseCase\RentalBid;

use Architecture\Application\DTO\RentalBidDTO;
use Architecture\Application\UseCase\Aparment\GetApartmentByIdUseCase;
use Architecture\Application\UseCase\Interface\CommandHandler;
use Architecture\Domain\Entity\RentalBidEntity;
use Architecture\Infrastructure\Repository\Interface\RepositoryInterface;
use Laminas\Hydrator\HydratorInterface;

class CreateRentalBidUseCase implements CommandHandler
{
    /**
     * @var RentalBidDTO $attributes
     */
    protected RentalBidDTO $attributes;

    public function __construct(
        protected RepositoryInterface $repository,
        protected HydratorInterface $hydrator,
        protected GetApartmentByIdUseCase $getApartmentById
    ) {
    }

    /**
     * @param RentalBidDTO $attributes
     * @return void
     */
    public function setInput(RentalBidDTO $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function execute(): object
    {
        $this->getApartmentById->setId($this->attributes->apartmentId);
        $apartment = $this->getApartmentById->execute();

        $rentalBid = new RentalBidEntity();
        $rentalBid->setActualBidValue($apartment->getLastBidValue());
        $rentalBid->canBeSavedWithValue($this->attributes->value);

        $this->hydrator->hydrate((array)$this->attributes, $rentalBid);

        $this->repository->setCollectionName('rental_bids', RentalBidEntity::class);

       // Implementar na próxima aula
       // $this->repository->setCollection('rental_bids');
        return $this->repository->save($rentalBid);
    }
}
