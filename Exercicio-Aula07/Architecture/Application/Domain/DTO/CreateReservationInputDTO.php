<?php

declare(strict_types=1);

namespace Architecture\Application\Domain\DTO;

use InvalidArgumentException;

class CreateReservationInputDTO
{
    public function __construct(
        private int $user_id,
        private int $stored_book_id,
        private string $reserved_at
    )
    { }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getStoredBookId(): int
    {
        return $this->stored_book_id;
    }

    public function getReservedAt(): string
    {
        return $this->reserved_at;
    }

    public function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'stored_book_id' => $this->stored_book_id,
            'reserved_at' => $this->reserved_at
        ];
    }
}