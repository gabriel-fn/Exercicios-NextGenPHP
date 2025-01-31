<?php

declare(strict_types=1);

namespace Architecture\Application\UseCase;

use Architecture\Application\Domain\Entity\ReservationEntity;

class RegisterReturnReservationUseCase 
{
    public function __construct(
        private FindReservationByIdUseCase $findReservationByIdUseCase,
        private UpdateReservationUseCase $updateReservationUserCase
    )
    { }

    public function execute(int $reservationId, string $returnDate): ReservationEntity
    {
        $reservationEntity = $this->findReservationByIdUseCase->execute($reservationId);
    
        $reservationEntity->canBeReturned($returnDate);

        $reservationEntity->returned_at = $returnDate;

        $this->updateReservationUserCase->execute($reservationEntity);

        return $reservationEntity;
    }
}