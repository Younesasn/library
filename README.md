# Welcome to Library 📚

![image](https://img.shields.io/badge/Symfony-000000?style=for-the-badge&logo=Symfony&logoColor=white) ![image](<https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white>)

Dans le cadre d'un test de compétences en Symfony, j'ai créé une simple application listant des livres appartenant à un utilisateur. Celui-ci peut en ajouter & supprimer.

## Installation

Commencez par installer les dépendances du projet :

```bash
composer install
```

Créez un fichier .env.local à la racine du projet pour configurer votre base de données :

```ini
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:port/db_name?serverVersion=8.0.32&charset=utf8mb4
```

Puis, lancez la commande suivante pour créer la base de données et les tables :

```bash
bin/console doctrine:database:create && bin/console doctrine:migrations:migrate
```

Chargez ensuite les données fictives :

```bash
bin/console doctrine:fixtures:load
```

Lancez la commande suivante pour construire le style CSS Tailwind :

``` bash
php bin/console tailwindcss:build --watch
```

Enfin, dans un autre terminal, lancez la commande suivante pour lancer le serveur web :

```bash
symfony serve --no-tls
```