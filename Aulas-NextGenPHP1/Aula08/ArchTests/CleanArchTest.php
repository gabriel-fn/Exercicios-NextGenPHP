<?php

namespace ArchTests;

use PHPat\Selector\Selector;
use PHPat\Test\Builder\Rule;
use PHPat\Test\PHPat;

final class CleanArchTest
{
    public function testValueObjectShouldBeReadOnly(): Rule
    {
        // ValueObject App\Domain\ValueObject\MinhaClasse
        return PHPat::rule()
            ->classes(Selector::inNamespace('App\Domain\ValueObject', true))
            ->shouldBeReadonly()
            ->because('Value Object Classes should be readonly');
    }

    public function testValueObjectShouldBeFinalClass(): Rule
    {
        // ValueObject App\Domain\ValueObject\MinhaClasse
        return PHPat::rule()
            ->classes(Selector::inNamespace('App\Domain\ValueObject'))
            ->shouldBeFinal()
            ->because('Value Object Classes should be final class');
    }

    public function testValueObjectShouldImplementsStringable(): Rule
    {
        // Essa checagem não verifica o "implements Stringable"
        // ele verifica se os métodos existem na classe no exemplo: __toString
        return PHPat::rule()
            ->classes(Selector::inNamespace('App\Domain\ValueObject'))
            ->shouldImplement()
            ->classes(Selector::classname('Stringable'))
            ->because('Value Object Classes should implements Stringable');
    }

}
