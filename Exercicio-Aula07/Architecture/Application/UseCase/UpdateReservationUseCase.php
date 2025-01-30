<?php

declare(strict_types=1);

namespace Architecture\Application\UseCase;

use Architecture\Application\Domain\Entity\ReservationEntity;
use Architecture\Application\Domain\Repository\ReservationRepositoryInterface;
use Exception;

class UpdateReservationUseCase
{
    public function __construct(
        private ReservationRepositoryInterface $reservationRepository
    )
    { }

    public function execute(ReservationEntity $reservationEntity): void
    {
        $result = $this->reservationRepository->update($reservationEntity);

        if (false === $result) {
            throw new Exception('Reservation could not be updated');
        }
    }
}