<?php

namespace Tests\Integration;

use Architecture\Application\UseCase\Aparment\GetApartmentByIdUseCase;
use Architecture\Application\UseCase\RentalBid\CreateRentalBidUseCase;
use Architecture\Domain\Entity\ApartmentEntity;
use Architecture\Domain\Entity\Exceptions\RentalBidValueException;
use Architecture\Domain\Entity\RentalBidEntity;
use Architecture\Infrastructure\Repository\Interface\RepositoryInterface;
use ArrayObject;
use Laminas\Hydrator\NamingStrategy\UnderscoreNamingStrategy;
use Laminas\Hydrator\ObjectPropertyHydrator;
use PHPUnit\Framework\TestCase;


class CreateRentalBidUseCaseTest extends TestCase
{
    protected ObjectPropertyHydrator $hydrator;

    protected RepositoryInterface $rentalRepository;

    protected RepositoryInterface $apartmentRepository;

    protected function setUp(): void
    {
        $this->hydrator = new ObjectPropertyHydrator();
        $this->hydrator->setNamingStrategy(new UnderscoreNamingStrategy());

        $this->rentalRepository = $this->createMock(RepositoryInterface::class);
        $this->rentalRepository->method('save')->willReturnCallback(function (RentalBidEntity $param) {
            $param->id = 1;
            return $param;
        });

        $this->apartmentRepository = $this->createMock(RepositoryInterface::class);
        $this->apartmentRepository->method('getById')->willReturnCallback(function (int $id) {
            $apartment = new ApartmentEntity();
            $apartment->id = $id;
            $apartment->initialPrice = 1200;
            return new ArrayObject([$apartment]);
        });
    }

    public function testCreateRentalBidUseCaseShouldValidateBidValue(): void
    {
        $getApartmentUseCase = new GetApartmentByIdUseCase($this->apartmentRepository);

        // Command Pattern - execute
        $createRentalBidUseCase = new CreateRentalBidUseCase(
            $this->rentalRepository,
            $this->hydrator,
            $getApartmentUseCase
        );

        $rentalDTO = (object)[
            'userId' => 1,
            'apartmentId' => 2,
            'value' => 1300.0
        ];

        $createRentalBidUseCase->setInput($rentalDTO);
        $result = $createRentalBidUseCase->execute();

        $this->assertEquals([
            'id' => 1,
            'user_id' => 1,
            'apartment_id' => 2,
            'value' => 1300.0
        ], $this->hydrator->extract($result));
    }

    public function testCreateRentalBidUseCaseShouldThrowExceptionIfBidValueIsLower(): void
    {
        $this->expectException(RentalBidValueException::class);
        $getApartmentUseCase = new GetApartmentByIdUseCase($this->apartmentRepository);

        // Command Pattern - execute
        $createRentalBidUseCase = new CreateRentalBidUseCase(
            $this->rentalRepository,
            $this->hydrator,
            $getApartmentUseCase
        );

        $rentalDTO = (object)[
            'userId' => 1,
            'apartmentId' => 2,
            'value' => 1100.0
        ];

        $createRentalBidUseCase->setInput($rentalDTO);
        $createRentalBidUseCase->execute();
    }

    public function testCreateRentalBidUseCaseShouldThrowExceptionIfApartmentNotFound(): void
    {
        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Apartment with id 3333 not found');

        $apartmentRepository = $this->createMock(RepositoryInterface::class);
        $apartmentRepository->method('getById')
                            ->willReturn(new ArrayObject());

        $getApartmentUseCase = new GetApartmentByIdUseCase($apartmentRepository);

        // Command Pattern - execute
        $createRentalBidUseCase = new CreateRentalBidUseCase(
            $this->rentalRepository,
            $this->hydrator,
            $getApartmentUseCase
        );

        $rentalDTO = (object)[
            'userId' => 1,
            'apartmentId' => 3333,
            'value' => 1300.0
        ];

        $createRentalBidUseCase->setInput($rentalDTO);
        $createRentalBidUseCase->execute();
    }
}
