<?php

declare(strict_types=1);

namespace Architecture\Application\Domain\Entity;

class ReservationEntity 
{
    public int $id;
    public int $user_id;
    public int $stored_book_id;
    public string $reserved_at;
    public string $returned_at;
    public string $created_at;
    public string $updated_at;
}