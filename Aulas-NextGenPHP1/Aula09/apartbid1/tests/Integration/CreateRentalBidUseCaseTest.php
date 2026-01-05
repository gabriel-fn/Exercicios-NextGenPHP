<?php

namespace Integration;

use Architecture\Application\UseCase\CreateRentalBidUseCase;
use Architecture\Domain\Entity\RentalBidEntity;
use Architecture\Infrastructure\Repository\Interface\RepositoryInterface;
use PHPUnit\Framework\TestCase;


class CreateRentalBidUseCaseTest extends TestCase
{
    public function testCreateRentalBidUseCaseShouldValidateBidValue(): void
    {
        $repository = $this->createMock(RepositoryInterface::class);
        $repository->method('save')->willReturnCallback(function (RentalBidEntity $param) {
            $param->id = 1;
            return $param;
        });

        // Command Pattern - execute
        $createRentalBidUseCase = new CreateRentalBidUseCase($repository);

        $rentalDTO = (object)[
            'userId' => 1,
            'apartmentId' => 2,
            'value' => 1300.0
        ];

        $createRentalBidUseCase->setInput($rentalDTO);

        $result = $createRentalBidUseCase->execute();

        $this->assertEquals([
            'id' => 1,
            'userId' => 1,
            'apartmentId' => 2,
            'value' => 1300.0
        ], $result->toArray());
    }
}
