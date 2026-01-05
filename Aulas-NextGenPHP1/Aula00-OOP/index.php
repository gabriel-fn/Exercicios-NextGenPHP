<?php

require __DIR__ . '/vendor/autoload.php';


$client = new Architecture\Client();

$customer = new PHPNextGen\CustomerPF();

$customer->name = 'João Pereira';
$customer->setDocument('234.334.223-33');

$customerPj = new PHPNextGen\CustomerPJ();
$customerPj->name = 'Company Name';
$customerPj->setDocument('12.3343.553/0001-33');

// chamada estática
// Classe::metodo(12, 23);
// funcao(12, 23);
// this

// Classe::$attributo = 123;

// Classe::metodo1();
// Classe::metodo2();

// $factory = Factory::make(...);

// $objeto = Factory::make('valor1', 'valor2');

// $factory('valor1', 'valor2');

// Strategy com factory sem container
// $paymentType = $paymentConfig->getPaymentType();
// $strategyPayment = $this->paymentStrategyFactory->make($paymentType);



class Magic
{
    public function __construct()
    {

    }

    // $obj->atributoNaoExistente = 123;
    // public function __set(string $name, mixed $value)
    // {
    //     $this->{$name} = $value;
    // }

    // public function __get(string $name): mixed
    // {
    //     return $this->{$name};
    // }

    public function __call(string $name, array $parameters): mixed
    {
        var_dump($parameters);
    }

    // serialize no objeto
    public function __sleep()
    {
        
    }

    // deserializa
    public function __wakeup()
    {
        
    }

    // o que o objeto deve imprimir
    public function __toString(): string
    {
        echo 'Teste 123';
    }
}


$magic = new Magic();
$magic->teste = 123;

echo $magic->teste;

// var_dump($customer, $customerPj);