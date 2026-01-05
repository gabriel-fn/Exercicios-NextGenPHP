<?php

namespace Architecture\Domain\Entity;

use Architecture\Domain\Entity\Exceptions\RentalBidValueException;

class RentalBidEntity
{
    public int $id;

    public int $userId;

    public int $apartmentId;

    public float $value;

    protected float $actualBidValue;

    public function setActualBidValue(float $actualBidValue): void
    {
        $this->actualBidValue = $actualBidValue;
    }

    /**
     * @param float $newBidValue
     * @return true
     * @throws RentalBidValueException
     */
    public function canBeSavedWithValue(float $newBidValue): true
    {
        if ($this->actualBidValue >= $newBidValue) {
            throw new RentalBidValueException('Bid value cannot be less or equal than actual bid.', 100);
        }
        return true;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'userId' => $this->userId,
            'apartmentId' => $this->apartmentId,
            'value' => $this->value,
        ];
    }
}
