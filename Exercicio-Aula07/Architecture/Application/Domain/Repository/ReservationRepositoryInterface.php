<?php

declare(strict_types=1);

namespace Architecture\Application\Domain\Repository;

use Architecture\Application\Domain\DTO\CreateReservationInputDTO;
use Architecture\Application\Domain\Entity\ReservationEntity;

interface ReservationRepositoryInterface
{
    public function findById(int $reservationId): ?ReservationEntity;

    public function create(CreateReservationInputDTO $reservationInputDTO): ReservationEntity;

    public function update(ReservationEntity $reservationEntity): bool;
}