<?php

namespace Architecture\Application\DTO;

readonly class ApartmentDTO
{
    public function __construct(
        public string $address,
        public string $number,
        public string $zipcode,
        public string $city,
        public string $state,
        public float $initialPrice,
        public int $userId,
        public string $latitude,
        public string $longitude,
        public string $complement = '',
    ) {

    }
}
