<?php

declare(strict_types=1);

namespace Architecture\Infrastructure\Repository;

use App\Models\User;
use Architecture\Application\Domain\Entity\UserEntity;
use Architecture\Application\Domain\Mapper\GenericObjectMapperInterface;
use Architecture\Application\Domain\Repository\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private GenericObjectMapperInterface $objectMapper
    )
    { }

    public function findById(int $userId): ?UserEntity
    {
        $userModel = User::find($userId);

        if (null === $userModel) {
            return null;
        }

        $userEntity = $this->objectMapper->map($userModel, UserEntity::class);

        return $userEntity;
    }
}