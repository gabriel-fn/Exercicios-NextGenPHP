<?php

namespace Tests\Unit;

use Architecture\Domain\Entity\Exceptions\RentalBidValueException;
use Architecture\Domain\Entity\RentalBidEntity;
use PHPUnit\Framework\TestCase;

class RentalBidEntityTest extends TestCase
{
    public function testRentalBidEntityShouldThrowAnExceptionWhenValueIsInvalid()
    {
        $this->expectException(RentalBidValueException::class);
        $this->expectExceptionCode(100);

        $rentalBid = new RentalBidEntity();
        $rentalBid->setActualBidValue(1_200);

        $rentalBid->canBeSavedWithValue(1_100);
    }

    public function testRentalBidEntityShouldValueShouldBeSaved()
    {
        $rentalBid = new RentalBidEntity();
        $rentalBid->setActualBidValue(1_200);

        $result = $rentalBid->canBeSavedWithValue(1_300);

        $this->assertTrue($result);
    }

    public function testRentalBidEntityShouldThrowAnExceptionWhenValueIsEqualToActualBidValue()
    {
        $this->expectException(RentalBidValueException::class);
        $this->expectExceptionCode(100);

        $rentalBid = new RentalBidEntity();
        $rentalBid->setActualBidValue(1_200);
        $rentalBid->canBeSavedWithValue(1_200);
    }
}
