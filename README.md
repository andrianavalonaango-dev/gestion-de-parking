# Gestion de parking

Application web de gestion des entrées et sorties d'un parking. Elle permet de suivre les véhicules présents, de calculer le montant dû à la sortie et de consulter l'historique des stationnements.

## Fonctionnalités

- Enregistrer l'entrée d'une voiture ou d'une moto et générer un ticket.
- Rechercher un véhicule à sa sortie par immatriculation ou numéro de ticket.
- Calculer la durée facturée par heure commencée, avec un minimum d'une heure.
- Calculer le tarif selon le type de véhicule : **500 Ar/heure** pour une voiture et **200 Ar/heure** pour une moto.
- Consulter les véhicules actuellement garés et l'historique des sorties.
- Afficher sur la page d'accueil le nombre de véhicules garés, les sorties et les revenus du jour, ainsi que le nombre total de véhicules.

L'interface et les messages sont en français. Les données des stationnements sont conservées dans la base de données.

## Technologies

- **Serveur :** PHP 8.2+, Laravel 12
- **Base de données par défaut :** SQLite
- **Interface :** Blade, Bootstrap 5 et Font Awesome
- **Assets :** Vite, Tailwind CSS 4 et JavaScript

## Prérequis

- PHP **8.2 ou supérieur**, avec les extensions nécessaires à Laravel et au pilote SQLite (`pdo_sqlite`).
- [Composer](https://getcomposer.org/)
- Node.js et npm

## Installation

Depuis le dossier du projet :

```bash
composer install
npm install
cp .env.example .env
```

Créez ensuite le fichier SQLite, générez la clé de l'application et lancez les migrations :

```bash
touch database/database.sqlite
php artisan key:generate
php artisan migrate
```

Enfin, compilez les assets et démarrez l'application :

```bash
npm run build
php artisan serve
```

Ouvrez [http://localhost:8000](http://localhost:8000) dans votre navigateur.

Pour le développement avec rechargement des assets et les outils Laravel associés, utilisez plutôt :

```bash
composer run dev
```

Cette commande démarre le serveur Laravel, Vite, le worker de file d'attente et le suivi des journaux. Elle nécessite les dépendances Composer et npm installées.

### Base de données

La configuration fournie utilise SQLite et le fichier `database/database.sqlite`. Pour utiliser MySQL ou un autre moteur pris en charge par Laravel, configurez les variables `DB_*` dans `.env`, puis exécutez les migrations.

## Parcours disponibles

| Page | URL | Description |
| --- | --- | --- |
| Accueil | `/` | Indicateurs du parking et accès aux opérations |
| Nouvelle entrée | `/entree` | Enregistrement d'une voiture ou d'une moto |
| Sortie | `/sortie` | Recherche du véhicule et enregistrement de son départ |
| Véhicules garés | `/gares` | Liste des véhicules actuellement présents |
| Historique | `/historique` | Liste paginée des véhicules sortis |

Un véhicule déjà enregistré comme garé ne peut pas être enregistré une seconde fois. Le numéro de ticket généré suit le format `PARK-0001`.

## Structure du projet

```text
app/
  Http/Controllers/VehicleController.php  Parcours des véhicules et calcul des montants
  Models/                                  Modèles Eloquent
database/
  migrations/                              Schéma de la base de données
resources/views/
  Home.blade.php                           Tableau de bord
  vehicles/                                Écrans d'entrée, de sortie et de suivi
routes/Web.php                             Routes de l'application
```

Le parcours opérationnel de l'interface repose sur le modèle `Vehicle`. Le projet contient également des modèles et migrations pour les clients, les parkings, les places, les abonnements et les tickets ; ces entités constituent une base de données complémentaire, mais ne sont pas encore intégrées aux parcours actuels de l'interface.

## Tests

Exécutez la suite de tests Laravel avec :

```bash
php artisan test
```

## Licence

La licence du projet n'est pas précisée dans le dépôt. Les dépendances conservent leurs licences respectives.
