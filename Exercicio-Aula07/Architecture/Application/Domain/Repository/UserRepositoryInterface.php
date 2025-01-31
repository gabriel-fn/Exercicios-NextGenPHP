<?php

declare(strict_types=1);

namespace Architecture\Application\Domain\Repository;

use Architecture\Application\Domain\Entity\UserEntity;

Interface UserRepositoryInterface
{
    public function findById(int $userId): ?UserEntity;
}