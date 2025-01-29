<?php

declare(strict_types=1);

namespace Architecture\Application\UseCase;

use Architecture\Application\Domain\DTO\CreateReservationInputDTO;
use Architecture\Application\Domain\Entity\ReservationEntity;
use Architecture\Application\Domain\Repository\ReservationRepositoryInterface;

class CreateReservationUseCase
{
    public function __construct(
        private ReservationRepositoryInterface $reservationRepository
    )
    { }

    public function execute(CreateReservationInputDTO $reservationInputDTO): ReservationEntity
    {
        return $this->reservationRepository->create($reservationInputDTO);
    }
}