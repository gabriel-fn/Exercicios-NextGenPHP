# Respostas do desafio da aula 01

## 1. Identifique a versão do PHP e Zend Engine

Para descobrir a versão de ambos dentro do conteiner, foi executado o seguinte comando:

```sh
$ docker compose exec php php -v

PHP 8.3.14 (cli) (built: Nov 21 2024 17:59:01) (NTS)
Copyright (c) The PHP Group
Zend Engine v4.3.14, Copyright (c) Zend Technologies
```

## 2. Liste as extensões instaladas

Para descobrir as extensões do PHP:

```sh
$ docker compose exec php php -m

[PHP Modules]
Core
ctype
curl
...
xmlwriter
zlib

[Zend Modules]
```

## 3. Identifique a localização do arquivo `php.ini` no contêiner

Para localizar o arquivo `php.ini`:

```sh
$ docker compose exec php php -ini

Configuration File (php.ini) Path: /usr/local/etc/php
Loaded Configuration File:         (none)
Scan for additional .ini files in: /usr/local/etc/php/conf.d
...
```

O php está buscando o arquivo `php.ini` no caminho `/usr/local/etc/php`, porém ele não foi encontrado. 

Mas o diretório `/usr/local/etc/php` possui 2 arquivos: `php.ini-development` e `php.ini-production`. 

Então, para resolver o problema, eu alterei o nome do `php.ini-development` para `php.ini`:

```sh
$ docker compose exec php mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
```

Executando o comando novamente: 

```sh
$ docker compose exec php php -ini

Configuration File (php.ini) Path: /usr/local/etc/php
Loaded Configuration File:         /usr/local/etc/php/php.ini
Scan for additional .ini files in: /usr/local/etc/php/conf.d
...
```

## 4. Substituia o arquivo interno do `php.ini` pelo novo usando volume

Dentro do arquivo `docker-compose.yml`, acrescentei a seguinte linha em volumes: 

```yml
volumes:
    - ".:/projeto"
    - "./php.ini:/usr/local/etc/php/php.ini"
```

## 5. Ajuste o horário padrão do PHP para `America/Sao_Paulo`

Dentro do arquivo `php.ini`, alterar a linha `date.timezone`:

```ini
; ANTES
;date.timezone = 

; DEPOIS
date.timezone = America/Sao_Paulo
```

## 6. Aumente o limite de memória do PHP para 512mbs

Dentro do arquivo `php.ini`, alterar o valor de `memory_limit`:

```ini
; ANTES
memory_limit = 128M

; DEPOIS
memory_limit = 512M
```

## 8. Corrija o erro de exibição do projeto

No arquivo `index.php`, a função `formatServices()` estava retornando o array `$services` quando deveria retornar a string `$servicesHtml`.

```php
/*
 *  ANTES
 */
function formatServices(string $servicesInline): string {
    /* ... */
    return $services;
}

/*
 *  DEPOIS
 */
function formatServices(string $servicesInline): string {
    /* ... */
    return $servicesHtml;
}
```

---