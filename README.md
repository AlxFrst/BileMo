
# BileMo API

[![Codacy Badge](https://app.codacy.com/project/badge/Grade/e0ceba28751d4be58f9f1e50d361f2f1)](https://app.codacy.com/gh/AlxFrst/BileMo/dashboard?utm_source=gh&utm_medium=referral&utm_content=&utm_campaign=Badge_grade)

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

4. Configurez les variables d'environnement dans le fichier `.env` et en modifiant les valeurs selon vos besoins :

```bash
cp .env
```

PS: Vous avez a disposition un docker-compose.yml pour lancer un container mysql:
Identifiant mysql docker
Base de donnée: BileMo
Utilisateur: BileMo
Mot de passe: BileMo

```bash
docker-compose up -d
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

