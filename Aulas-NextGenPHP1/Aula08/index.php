<?php
declare(strict_types=1);

namespace Aula08;

use Faker\Core\DateTime;

class TesteComponent
{
    /**
     * @var string[] // [1 => 'teste']
     * @var list<string> // [0 => 'teste']
     * @var array< int, array<string, string|float|int> >
     * @var array< int, array<string, string|float|int> >
     *
     * [
     *    0 => ['id' => 1, 'nome' => 'Leonardo']
     * ]
     */
    protected int $teste;

    public function __construct(
        private readonly string $nome = ''
    ) {
        // $date = \DateTime::createFromFormat('Y-m-d', '2020-01-01');

//        $email = $_POST['email'];
//        $session = $_SESSION['value'];
    }

    /**
     * Do lado direito chave(key) => valor(value)
     * da array
     * @return list<string>
     */
    public function getNome(): array
    {
        $nome = $this->nome;

        $retorno = [];

        /** @var object $result */
        $result = $this->teste2();

        $this->getTeste2($result);

        if ($this->teste === 1) {
            echo $nome;
            //exit;
        }
        //eval('echo "PERIGO!!";');
        return $retorno;
    }

    /**
     * @return object{attribute: string}|false
     */
    public function teste2(): object|false
    {
        if ($this->teste) {
            return false;
        }
        return new class {
            public string $attribute;
        };
    }

    /**
     * @param object{attribute: string} $obj
     * @return void
     */
    public function getTeste2(object $obj): void
    {
        echo strrev($obj->attribute);
    }
}

class AB
{

}

class A
{
    public function ge()
    {

    }
}
