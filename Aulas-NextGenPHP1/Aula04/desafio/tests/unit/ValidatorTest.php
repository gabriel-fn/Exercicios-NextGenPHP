<?php

use DifferDev\Validator;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Validator::class)]
final class ValidatorTest extends \PHPUnit\Framework\TestCase
{
    public function testClassValidatorShouldValidateIsInteger(): void
    {
        $result = Validator::validateInteger('1');
        $this->assertTrue($result);

        $result = Validator::validateInteger('-2');
        $this->assertTrue($result);
    }

    public function testClassValidatorShouldValidateIsNotInteger(): void
    {
        $result = Validator::validateInteger('123.22');
        $this->assertFalse($result);
    }

    public function testClassValidatorShouldValidateMultipleValidations(): void
    {
        $value = '302';
        $result1 = Validator::validateInteger($value);
        $result2 = Validator::validateGreaterThan($value, 200);
        $result3 = Validator::validateEven($value);

        // lw($result1, $result2, $result3);

        $this->assertTrue($result1 && $result2 && $result3);
    }


    // Trocar o nome deste teste para que rode
    public function notATestClassValidatorShouldAggregateMultipleValidations(): void
    {
        // Exemplo que deve ser implementado
        $validator = new Validator();

        // Esse é um exemplo você pode criar uma interface completamente diferente
        // use sua criatividade!
        $validationGroup = $validator->addValidation(new IsInteger())
                                     ->addValidation(new IsGreaterThan(200))
                                     ->addValidation(new IsEven())
                     ;

        /**
         * O valor passado é inteiro, maior que 200 e par
         */
        $result = $validationGroup->validate(302);

        $this->assertTrue($result);
    }
}
