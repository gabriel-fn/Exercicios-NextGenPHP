<?php

declare(strict_types=1);

namespace Architecture\Application\Domain\Entity;

use Exception;

class ReservationEntity 
{
    public int $id;
    public int $user_id;
    public int $stored_book_id;
    public string $reserved_at;
    public ?string $returned_at;
    public string $created_at;
    public string $updated_at;

    public function getReservedDays(): int
    {
        $reservedAt = new \DateTimeImmutable($this->reserved_at);
        $returnedAt = new \DateTimeImmutable($this->returned_at);
        $reservedDays = $returnedAt->diff($reservedAt)->days;
        return $reservedDays;
    }

    public function getReservationCost(float $costPerDay): string
    {
        $reservationCost = 'R$ ' . number_format($this->getReservedDays() * $costPerDay, 2, ',', '.');
        return $reservationCost;
    }

    public function canBeReturned(string $returnDate)
    {
        if (null !== $this->returned_at) {
            throw new Exception('Reservation already returned', 403);
        }

        if ($returnDate <= $this->reserved_at) {
            throw new Exception('Return date must be greater than reserved date', 403);
        }
    }
}