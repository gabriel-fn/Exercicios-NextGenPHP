<?php

namespace Architecture\Application\UseCase\Aparment;

use Architecture\Application\UseCase\Interface\CommandHandler;
use Architecture\Domain\Entity\ApartmentEntity;
use Architecture\Infrastructure\Repository\Interface\RepositoryInterface;
use ArrayObject;
use Exception;

class GetApartmentByIdUseCase implements CommandHandler
{
    protected int $id;

    public function __construct(
        protected RepositoryInterface $repository
    ) {
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return ApartmentEntity
     * @throws Exception
     */
    public function execute(): ApartmentEntity
    {
        /**
         * @var ArrayObject<int, ApartmentEntity> $apartment
         */
        $apartment = $this->repository->getById($this->id);
        if (false === isset($apartment[0])) {
            throw new Exception("Apartment with id {$this->id} not found");
        }
        return $apartment[0];
    }
}
