
# Documentation de l'API BileMo 📱

## Introduction 📚

Bienvenue dans la documentation de l'API BileMo. Cette API permet aux plateformes de consulter et gérer les produits et utilisateurs de BileMo. L'accès à l'API est sécurisé via OAuth ou JWT et les données sont servies en JSON.

## Endpoints 🛠️

### Authentification 🔐

#### Login Check

- **URL**: `/api/auth/login_check`
- **Méthode**: `POST`
- **Description**: Permet de vérifier les informations de connexion et de récupérer un token JWT.
- **Headers**:
  - `Content-Type: application/json`
  - `accept: application/json`
- **Corps de la requête**:
  ```json
  {
    "username": "test@test.com",
    "password": "test"
  }
  ```

### Produits 📦

#### Liste des Smartphones

- **URL**: `/api/smartphones?page=1`
- **Méthode**: `GET`
- **Description**: Récupère la liste des smartphones disponibles.
- **Headers**:
  - `Authorization: Bearer TOKEN`
  - `accept: application/ld+json`

#### Détails d'un Smartphone

- **URL**: `/api/smartphones/{uuid}`
- **Méthode**: `GET`
- **Description**: Récupère les détails d'un smartphone spécifique.
- **Headers**:
  - `Authorization: Bearer TOKEN`
  - `accept: application/ld+json`

### Utilisateurs 👥

#### Liste des Clients

- **URL**: `/api/customers?page=1`
- **Méthode**: `GET`
- **Description**: Récupère la liste des clients inscrits.
- **Headers**:
  - `Authorization: Bearer TOKEN`
  - `accept: application/ld+json`

#### Détails d'un Client

- **URL**: `/api/customers/{uuid}`
- **Méthode**: `GET`
- **Description**: Récupère les détails d'un client spécifique.
- **Headers**:
  - `Authorization: Bearer TOKEN`
  - `accept: application/ld+json`

#### Création d'un Client

- **URL**: `/api/customers`
- **Méthode**: `POST`
- **Description**: Ajoute un nouvel utilisateur lié à un client.
- **Headers**:
  - `Authorization: Bearer TOKEN`
  - `Content-Type: application/ld+json`
  - `accept: application/ld+json`
- **Corps de la requête**:
  ```json
  {
    "lastName": "Alexandre",
    "firstName": "Forestier",
    "facturationAddress": "2 rue du bois",
    "email": "alex@lol.com"
  }
  ```

#### Suppression d'un Client

- **URL**: `/api/customers/{uuid}`
- **Méthode**: `DELETE`
- **Description**: Supprime un utilisateur ajouté par un client.
- **Headers**:
  - `Authorization: Bearer TOKEN`
  - `accept: */*`

### Revendeurs 🏢

#### Création d'un Revendeur

- **URL**: `/api/resellers`
- **Méthode**: `POST`
- **Description**: Crée un nouveau revendeur.
- **Headers**:
  - `Authorization: Bearer TOKEN`
  - `Content-Type: application/ld+json`
  - `accept: application/ld+json`
- **Corps de la requête**:
  ```json
  {
    "email": "bilemo@bilemo.com",
    "password": "BileMoTest@123",
    "companyName": "BileMo"
  }
  ```

## Authentification et Sécurité 🔒

L'accès à l'API est restreint aux clients authentifiés. Chaque requête doit inclure un token JWT valide dans les headers.

- **Header**: `Authorization: Bearer {TOKEN}`

## Codes de Réponse HTTP 📬

- `200 OK`: Requête réussie.
- `201 Created`: Ressource créée avec succès.
- `204 No Content`: Ressource supprimée avec succès.
- `400 Bad Request`: Mauvaise requête.
- `401 Unauthorized`: Non authentifié.
- `403 Forbidden`: Accès interdit.
- `404 Not Found`: Ressource non trouvée.
- `500 Internal Server Error`: Erreur interne du serveur.

## Contact 📧

Pour toute question ou assistance, veuillez contacter l'équipe de support de BileMo à [support@bilemo.com](mailto:support@bilemo.com).

---

Merci d'utiliser l'API BileMo ! 🚀
