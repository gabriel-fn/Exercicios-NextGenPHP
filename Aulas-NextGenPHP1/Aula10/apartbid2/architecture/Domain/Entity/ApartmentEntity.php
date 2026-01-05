<?php

namespace Architecture\Domain\Entity;

use Architecture\Domain\Entity\ValueObject\EntityId;

class ApartmentEntity
{
    public int $id;

    public string $address;

    public int $number;

    public string $complement;

    public string $zipcode;

    public string $city;

    public string $state;

    public float $initialPrice;

    public int $userId;

    public string $latitude;

    public string $longitude;

    public function getLastBidValue(): float
    {
        // capturar o ultimo lance se houver
        return $this->initialPrice;
    }
}
