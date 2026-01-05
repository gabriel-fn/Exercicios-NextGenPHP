<?php
// intervalo voltamos 21:25
class MyClass
{
    protected object $elements;

    public function myMethodName()
    {
        if ($this->elements->hasElement()) {
            if ($this->elements->hasName()) {
                return 'element has name';
            } elseif ($this->elements->hasAddress()) {
                if ($this->elements->hasZip()) {
                    return 'element has address and zip';
                } else {
                    return 'element has only address';
                }
            }
        } else {
            return 'no elements';
        }
    }
}
// Aplicando Calisthenics 2 - sem else
class MyClass2
{
    protected object $elements;

    // retirar elses
    public function myMethodName(): string
    {
        if (false === $this->elements->hasElement()) {
            return 'no elements';
        }
        if ($this->elements->hasName()) {
            return 'element has name';
        }
        if (false === $this->elements->hasAddress()) {
            return 'element has not address';
        }
        if ($this->elements->hasZip()) {
            return 'element has address and zip';
        }
        return 'element has only address';
    }
}

