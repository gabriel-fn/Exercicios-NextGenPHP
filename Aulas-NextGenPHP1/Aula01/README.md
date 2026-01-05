## Slides
[Aula1](Aula1.pdf)

## Para compilar o PHP

1. Clonar o repositorio do Github
```sh
git clone git@github.com:php/php-src.git
```

2. Trocar versão de release
```sh
cd php-src
git checkout php-8.4.0RC3
```

3. Entrar no container
```sh
docker compose up -d
docker compose exec ubuntu bash
```

4. Instalar dependencias
```sh
apt install -y pkg-config build-essential autoconf bison re2c \
        libxml2-dev libsqlite3-dev
```

5. Build do config
```sh
./buildconf
```

6. Configure e compilação
```sh
./configure --enable-debug

# -j Quantidade de jobs(threads)
make -j4
```