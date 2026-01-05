<?php

namespace Architecture\Application\UseCase;

use Architecture\Application\UseCase\Interface\CommandHandler;
use Architecture\Domain\Entity\RentalBidEntity;
use Architecture\Infrastructure\Repository\Interface\RepositoryInterface;

class CreateRentalBidUseCase implements CommandHandler
{
    /**
     * @var object{userId: int, apartmentId: int, value: float} $attributes
     */
    protected object $attributes;

    public function __construct(
        protected RepositoryInterface $repository,
    ) {
    }

    /**
     * @param object{userId: int, apartmentId: int, value: float} $attributes
     * @return void
     */
    public function setInput(object $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function execute(): object
    {
        // Implementar na próxima aula
        // $this->repository->setCollection('apartments');
        // $apartmentEntity = $this->repository->getById($this->attributes->apartmentId);

        $rentalBid = new RentalBidEntity();
        $rentalBid->setActualBidValue(1200);
        $rentalBid->canBeSavedWithValue($this->attributes->value);

        $rentalBid->userId = $this->attributes->userId;
        $rentalBid->apartmentId = $this->attributes->apartmentId;
        $rentalBid->value = $this->attributes->value;

       // Implementar na próxima aula
       // $this->repository->setCollection('rental_bids');
       $rentalBidWithId = $this->repository->save($rentalBid);

        return $rentalBidWithId;
    }
}
