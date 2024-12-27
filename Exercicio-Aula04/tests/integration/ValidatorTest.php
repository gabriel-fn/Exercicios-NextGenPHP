<?php

use DifferDev\{
    IsEven,
    IsGreaterThan,
    IsInteger,
    Validator
};
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Validator::class)]
#[CoversClass(IsEven::class)]
#[CoversClass(IsGreaterThan::class)]
#[CoversClass(IsInteger::class)]
final class ValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testClassValidatorShouldValidateIsInteger(): void
    {
        $validator = new Validator();
        $validator->addValidation(new IsInteger());
        $result = $validator->validate('1');

        $this->assertTrue($result);

        $validator2 = new Validator();
        $validator2->addValidation(new IsInteger());
        $result2 = $validator2->validate('-2');

        $this->assertTrue($result2);
    }

    public function testClassValidatorShouldValidateIsNotInteger(): void
    {
        $validator = new Validator();
        $validator->addValidation(new IsInteger());
        $result = $validator->validate('123.22');

        $this->assertFalse($result);
    }

    public function testClassValidatorShouldAggregateMultipleValidations(): void
    {
        $validator = new Validator();

        $validationGroup = $validator->addValidation(new IsInteger())
                                     ->addValidation(new IsGreaterThan(200))
                                     ->addValidation(new IsEven());

        $result = $validationGroup->validate('302');

        $this->assertTrue($result);
    }

    public function testClassValidatorShouldAggregateMultipleValidationsWithOneFalse(): void
    {
        $validator = new Validator();

        $validationGroup = $validator->addValidation(new IsInteger())
                                     ->addValidation(new IsGreaterThan(400))
                                     ->addValidation(new IsEven());

        $result = $validationGroup->validate('302');

        $this->assertFalse($result);
    }
}
