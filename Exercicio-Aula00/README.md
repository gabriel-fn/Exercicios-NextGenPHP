# Exercício Aula 00 de OOP

## Passo a passo para executar o código do exercício

Em primeiro lugar, suba o docker conteiner:

```
docker compose up -d
```

Depois instale as dependências do composer (pode-se utilizar o script em `./shell/composer` para auxiliar nesta etapa):

```
./shell/composer install
```

Por fim, execute os testes com o seguinte comando:

```
./shell/composer phpunit
```

---
⌨️ por [Gabriel Nascimento](https://www.linkedin.com/in/gabriel-fn/)