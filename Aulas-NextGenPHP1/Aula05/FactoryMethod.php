<?php

class Destination
{

}

// Adiar a instanciação de uma classe
class FactoryMethod
{
    public function make(): Destination
    {
        return new Destination('valor', 'valor');
    }

    public function makeDecorated(): Destination
    {
        $destination = $this->make();
        $destination->setDecaration();
        return $destination;
    }
}

class Singleton
{
    protected array $instance;

    public function instance(string $className): object
    {
        if (isset($this->instance[$className])) {
            return $this->instance[$className];
        }
        $this->instance[$className] = new $className();
        return $this->instance[$className];
    }
}

// injetado
$destinationFactory = new FactoryMethod();


$destination = $destinationFactory->make();

$destination = $destinationFactory->make();

$destination = $destinationFactory->makeDecorated();

// singleton
$singletonClass = new Singleton();
$minhaClass = $singletonClass->instance(MyClass::class);
