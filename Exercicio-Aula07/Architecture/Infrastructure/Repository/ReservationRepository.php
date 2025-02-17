<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Repository;

use App\Models\Reservation;
use Architecture\Application\Domain\DTO\CreateReservationInputDTO;
use Architecture\Application\Domain\Entity\ReservationEntity;
use Architecture\Application\Domain\Mapper\GenericObjectMapperInterface;
use Architecture\Application\Domain\Repository\ReservationRepositoryInterface;

class ReservationRepository implements ReservationRepositoryInterface
{
    public function __construct(
        private GenericObjectMapperInterface $objectMapper
    )
    { }

    public function findById(int $reservationId): ?ReservationEntity
    {
        $reservationModel = Reservation::find($reservationId);

        if (null === $reservationModel) {
            return null;
        }

        $reservationEntity = $this->objectMapper->map($reservationModel, ReservationEntity::class);

        return $reservationEntity;
    }

    public function create(CreateReservationInputDTO $reservationInputDTO): ReservationEntity
    {
        $reservationModel = Reservation::create($reservationInputDTO->toArray());

        $reservationEntity = $this->objectMapper->map($reservationModel, ReservationEntity::class);

        return $reservationEntity;
    }

    public function update(ReservationEntity $reservationEntity): bool
    {
        $reservationModel = Reservation::find($reservationEntity->id);

        if (null === $reservationModel) {
            return false;
        }

        $reservationModel->user_id = $reservationEntity->user_id;
        $reservationModel->stored_book_id = $reservationEntity->stored_book_id;
        $reservationModel->reserved_at = $reservationEntity->reserved_at;
        $reservationModel->returned_at = $reservationEntity->returned_at;

        return $reservationModel->save();
    }
}