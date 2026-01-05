<?php
declare(strict_types=1);

namespace PHPNextGen;

final class CustomerPF extends BaseCustomer
{
    public string $name;

    private string $age;

    public function setAge(int $age): void
    {
        if ($age < 18 || $age > 100) {
            throw new \Exception('Age is not valid');
        }
        $this->age = $age;
    }
}
