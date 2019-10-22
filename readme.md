# SINPROSER


Sistema desenvolvido para atender um sindicato do interior do Maranhão.

O SINPROSER tem como objetivo gerenciar:

  - Associados
    -   Cadastro de associado
    -   Geração de formulário de associação
    -   Geração de carteira individualizado
  - Contribuição sindical (Financeiro)
  - Gerenciamento de fornecedores
  - Gerencia de bens (aluguel)
  - Gerenciamento de documentos
  - Relatórios
### Requesitos

O sistema utiliza Laravel 5.7, portanto, PHP 7.1.3^, VueJS 2.5^ e MySQL.

### Installation

Execute os comandos abaixo
```sh
$ git clone https://github.com/JosivanSous4/sinproser.git && cd sinproser
$ composer install
```
Renomei o arquivo .env.example para .env e depois gera a key
```sh
$ php artisan key:generate
```

Rode as migrates e seeds
```sh
$ php artisan migrate --seed
```
Configure o VueJS

```sh
$ npm install
```

Rode o watchify

```sh
$ npm run watchify
```


Pronto!!!!! ;)
