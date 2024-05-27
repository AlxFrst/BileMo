
# BileMo API

## Introduction

BileMo est une entreprise offrant une sélection de téléphones mobiles haut de gamme. Ce projet consiste à développer une API permettant à des plateformes partenaires d'accéder au catalogue de produits BileMo ainsi qu'à la gestion des utilisateurs.

## Prérequis

- PHP 8.1 ou supérieur
- Composer
- Symfony CLI
- MySQL ou un autre SGBD compatible
- OpenSSL pour la génération des clés JWT

## Installation

1. Clonez le repository :

```bash
git clone https://github.com/AlxFrst/BileMo
```

2. Accédez au répertoire du projet :

```bash
cd BileMo
```

3. Installez les dépendances :

```bash
composer install
```

4. Configurez les variables d'environnement en créant un fichier `.env.local` à partir du modèle `.env` et en modifiant les valeurs selon vos besoins :

```bash
cp .env .env.local
```

5. Générez les clés JWT :

```bash
mkdir -p config/jwt
openssl genpkey -out config/jwt/private.pem -algorithm rsa -pkeyopt rsa_keygen_bits:4096
openssl pkey -in config/jwt/private.pem -out config/jwt/public.pem -pubout
```

6. Configurez la base de données :

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

7. Chargez les fixtures :

```bash
php bin/console doctrine:fixtures:load
```

8. Démarrez le serveur Symfony :

```bash
symfony server:start
```

## Utilisation

### Authentification

Pour obtenir un token JWT, envoyez une requête POST à `/api/auth/login_check` avec les informations d'identification suivantes :

```json
{
    "email": "test@bilemo.com",
    "password": "testpassword"
}
```

### Documentation de l'API

La documentation complète de l'API est disponible à l'adresse suivante :

[Documentation de l'API](http://localhost:8000/api/docs)

## Tests

