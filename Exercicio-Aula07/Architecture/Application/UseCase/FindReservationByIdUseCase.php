<?php

declare(strict_types=1);

namespace Architecture\Application\UseCase;

use Architecture\Application\Domain\Entity\ReservationEntity;
use Architecture\Application\Domain\Exception\NotFoundResourceException;
use Architecture\Application\Domain\Repository\ReservationRepositoryInterface;

class FindReservationByIdUseCase
{
    public function __construct(
        private ReservationRepositoryInterface $reservationRepository
    )
    { }

    public function execute(int $reservationId): ReservationEntity
    {
        $reservationEntity = $this->reservationRepository->findById($reservationId);

        if (null === $reservationEntity) {
            throw new NotFoundResourceException('Reservation not found', 404);
        }

        return $reservationEntity;
    }
}