# BileMo

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/2cf89237dae9499db076353bba9a4c26)](https://app.codacy.com/gh/aerial978/bilemo/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

BileMo is a API REST designed to allow all online sales platforms to access a supplier's catalog of high-end mobile phones.

Project 7 of the Openclassrooms training "PHP/Symfony Application Developper".

## Tech Stack

* Symfony 6.3, Api Platform 3.1

## Launch

* Wampserver 64bit 3.2.6
* MySQL 5.7.36
* github/aerial978

## Set Up

* Symfony, Api Platform, Faker PHP

```bash
    composer create-project symfony/skeleton
    composer require api
    composer require fakerphp/faker
```

* Git clone the project

```bash
    https://github.com/aerial978/bilmo.git
```

* Database

Update .env file your database configuration

```bash
    DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/db_name"
```

* Create database

```bash
    php bin/console doctrine:database:create
```

* Create an entity

```bash
    php bin/console --dev symfony/maker-bundle
    php bin/console make:entity
```

* Create database structure

```bash
    php bin/console make:migration
```

* Database up-to-date

```bash
    php bin/console doctrine:migrations:migrate
```

* Insert data fixtures

```bash
    php bin/console doctrine:fixtures:load
```





