## Uma api em laravel

Para corresponder a pedida do teste, desenvolvi uma api com a temática Livros, onde há a possibilidade de adicionar
novos
livros, com categoria, número de páginas, tipo (físico ou digital), autor do livro e código. Acredito que consegui
demonstrar
um pouco do meu know-how em Laravel e desenvolvimento de api.

## Detalhes importantes

- Para facilitar a instalação e teste da api, eu adicionei o docker.
- Criei algumas seeders para popular o banco de dados desde o início, mas encorajo-vos a adicionar seus próprios dados
  para testar rotas de POST
- Utilizei a metodologia de Git Flow para entenderem um pouco de como eu "commito" e etc.
- Criei uma camada de service para isolar a regra de negócio e não poluir os controllers.
- Utilizei o swagger, conforme solicitado.

## Requisitos

- Docker:
- [Docker para ubuntu](https://docs.docker.com/engine/install/ubuntu/)
- [Docker para windows](https://docs.docker.com/desktop/install/windows-install/)

Caso queria utilizar o WSL2, no windows, acesse [aqui](https://docs.docker.com/desktop/wsl/).

## Rodando a Api

Clone o repositório e copie o env:

`$ git clone https://github.com/devEzequiel/liberfly-test` <br />
`$ cd liberfly-test` <br />
`$ cp .env.example .env` <br />

Certifique-se que a porta Local 8989 esteja disponível <br />.
Certifique-se que a porta Local 3306 (MySQL) esteja disponível <br />.

Então, suba o container, instale as dependecias e etc:

1. `$ docker-compose up -d`
2. `$ docker exec -it "liberfly-app-1" bash`
3. `$ composer install`
4. `$ php artisan migrate:fresh --seed`
5. `$ php artisan key:generate`
6. `$ php artisan l5-swagger:generate`

Assim a api está funcionando em `localhost:8989` e a documentação em `localhost:8989/api/documentation`

## Auth

As únicas rotas livres são as de Login e Cadastro (signup).
Para acessar as demais, é necessário um **Bearer Token** que é retornado no Response do Login.
<br />

Pode utilizar o login abaixo para testes, caso queria:

``` json
{
  "email": "user@test.com",
  "password": "test123"
}
```

Existem algumas categorias de livros já criadas, caso queria utilizar:

``` json
{
    "id": 1,
    "name": "romance",
    "slug": "romance"
},
{
    "id": 2,
    "name": "ficção",
    "slug": "ficcao"
},
{
    "id": 3,
    "name": "fantasia",
    "slug": "fantasia"
},
{
    "id": 4,
    "name": "mistério",
    "slug": "misterio"
}
```

e os tipos de arquivos (file_type) são:

``` json
{
    "id": 1,
    "name": "physical"
},
{
    "id": 2,
    "name": "digital"
}
```
