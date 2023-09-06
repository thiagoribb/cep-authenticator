# CEP Authenticator

## Configurar banco de dados

Acessar o mysql e rodar:

`create database nome_do_banco`

Copiar .env.example e colar como env. Atualizar as variáveis do banco de dados:

DB_DATABASE=nome_do_banco
DB_USERNAME=root
DB_PASSWORD=senha

## Instalar composer

`composer install`

## Instalar dependencias

`npm install`

## Gerar chave

`php artisan key:generate`

## Rodar migrations

`php artisan migrate`

## Rodar o projeto

Em um terminal, rodar:

`php artisan serve`

Em um terminal separado, rodar:

`npm run dev`

### A aplicação vai estar rodando na porta [http://127.0.0.1:8000]
