<?php

interface Teste
{
    public string $fullName {get;}
}

class Customer implements Teste
{
    public string $fullName {
        get => $this->name . ' ' . $this->surname;
    }

    public function __construct(
        public string $name,
        public string $surname
    ) {

    }
}

$customer = new Customer('Leonardo', 'Tumadjian');

echo $customer->fullName;