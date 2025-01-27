<?php

declare(strict_types=1);

namespace Architecture\Application\Domain\Repository;

use Architecture\Application\Domain\Entity\ReservationEntity;

interface ReservationRepositoryInterface
{
    public function findById(int $reservationId): ?ReservationEntity;
}