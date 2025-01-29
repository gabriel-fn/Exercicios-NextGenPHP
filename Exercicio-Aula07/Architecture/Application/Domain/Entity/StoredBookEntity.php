<?php

declare (strict_types=1);

namespace Architecture\Application\Domain\Entity;

class StoredBookEntity
{
    public int $id;
    public int $book_id;
    public string $created_at;
    public string $updated_at;
}