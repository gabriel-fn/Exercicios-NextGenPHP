<?php
declare(strict_types=1);

namespace DifferDev;

use DifferDev\Exception\FailValidationException;
use DifferDev\Interface\ValidationHandler;

class Validator
{
    /** @var array<ValidationHandler> */
    protected array $validations;

    public function __construct() {
        $this->validations = array();
    }

    public function addValidation(ValidationHandler $validation): Validator 
    {
        $this->validations[] = $validation;
        return $this;
    }

    public function validate(string $value): bool
    {
        try {
            $this->executeValidations($value);
        } catch (FailValidationException $e) {
            return false;
        }

        return true;
    }

    protected function executeValidations(string $value)
    {
        foreach ($this->validations as $validation) {
            $validation->execute($value);
        }
    }
}
