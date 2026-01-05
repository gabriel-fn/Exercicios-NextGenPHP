<?php

namespace Tests\Integration;

use Architecture\Application\DTO\ApartmentDTO;
use Laminas\Hydrator\NamingStrategy\UnderscoreNamingStrategy;
use Laminas\Hydrator\ObjectPropertyHydrator;
use PHPUnit\Framework\TestCase;

class SaveApartmentUseCaseTest extends TestCase
{
    public function testSaveApartmentUseCaseShouldSaveAnApartment(): void
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
        $hydrator = new ObjectPropertyHydrator();
        $hydrator->setNamingStrategy(new UnderscoreNamingStrategy());

        $apartmentDTO = new ApartmentDTO(
            'Rua Teste',
            '122',
            '1233444',
            'São Paulo',
            'SP',
            100,
            2,
            -46.606118946086,
            -23.53887012313072,
        );

        $this->saveApartmentUseCase->setApartment($apartmentDTO);
        $apartment = $this->saveApartmentUseCase->execute();

        $this->assertEquals([
            'id' => 1,
            'address' => 'Rua Teste',
            'number' => '122',
            'zipcode' => '1233444',
            'city' => 'São Paulo',
            'state' => 'SP',
            'initial_price' => 100,
            'user_id' => 2,
            'latitude' => -46.606118946086,
            'longitude' => -23.53887012313072,
        ], $hydrator->extract($apartment));

    }
}
