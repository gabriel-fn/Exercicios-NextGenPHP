<?php

declare(strict_types=1);

namespace Architecture\Application\UseCase;

use Architecture\Application\Domain\Entity\UserEntity;
use Architecture\Application\Domain\Exception\NotFoundResourceException;
use Architecture\Application\Domain\Repository\UserRepositoryInterface;

class FindUserByIdUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    )
    { }

    public function execute(int $userId): UserEntity
    {
        $userEntity = $this->userRepository->findById($userId);

        if (null === $userEntity) {
            throw new NotFoundResourceException('User not found', 404);
        }

        return $userEntity;
    }
}