<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

# Gabon Lab — Documentation du projet

Résumé complet et guide d'utilisation du projet.

## 1. Aperçu
Gabon Lab (référencé dans le code comme "GabonÉcho" ou "GabBlog") est une application web construite avec le framework Laravel. L'extrait fourni contient une vue Blade destinée au rôle "Directeur" (resources/views/auth/director/dashboard.blade.php). Cette vue est une interface décisionnelle (dashboard) présentant des KPI, des graphiques et des outils de gestion (PCO, bulletin officiel, utilisateurs, activité et santé du système).

Le front-end exploite Chart.js (CDN) pour les graphiques et effectue des appels à des API REST internes exposées par l'application Laravel.

## 2. Fonctionnalités visibles dans la vue fournie
- Tableau de bord pour le rôle Directeur avec:
  - KPIs : nombre d'utilisateurs, nombre d'articles (récupéré via $user->articles()->count()), propositions sur 30 jours, taux de résolution des signalements.
  - Graphiques : tendances des propositions et signalements, et un graphique utilisateurs.
  - Liste des derniers utilisateurs actifs et des PCOs.
  - Formulaire modal pour créer un PCO (nom, email, type de rôle).
  - Zone de rédaction d'un bulletin officiel (publication / sauvegarde brouillon).
  - Bouton de déconnexion (form POST vers route('logout')).
  - Bouton pour revenir à la page d'accueil (route('home')).

## 3. Architecture attendue et éléments backend correspondants
La vue suppose une application Laravel classique :
- Fichiers Blade sous resources/views/
- Contrôleurs sous app/Http/Controllers/ probablement un contrôleur `DirectorController` ou `DashboardController` rendant la vue pour le Directeur.
- Routes web (routes/web.php) pour l'affichage de la vue (middleware d'auth + vérification du rôle).
- Routes API (routes/api.php) servant les endpoints consommés par la vue.

Endpoints explicitement utilisés par la vue (frontend JavaScript) :
- GET /api/director/kpis
  - Réponse attendue (JSON) : { users: number, articles: number, proposals: number, resolution_rate: number }
- GET /api/director/proposals/trend?days=30
  - Réponse attendue (JSON) : { labels: ["2025-..."], data: [number, ...] }
- GET /api/director/reports/trend?days=30
  - Réponse attendue (JSON) : { labels: [...], data: [...] }
- GET /api/director/pcos
  - Réponse attendue (JSON) : [ { name: string, email: string, pco_type: string, last_login?: string }, ... ]

Notes additionnelles :
- La page utilise la variable Blade $user (utilisateur connecté) et appelle $user->articles()->count() — il faut s'assurer que la relation articles() existe sur le modèle User.
- Le formulaire de création de PCO est traité côté client par submitCreatePco(event) (fonction JS attendue côté frontend ou endpoint API POST /api/director/pcos).

## 4. Modèles et relations suggérées
- User
  - relations : articles() -> hasMany(Article)
  - champs pertinents : id, first_name, last_name, email, role, last_login, password, etc.
- Article
  - champs : id, user_id, title, body, status, published_at, etc.
- PCO (si modélisé séparément) ou User avec rôle pco
  - champs : id, name, email, pco_type, created_by, last_login

## 5. Sécurité, rôles et permissions
- Middleware d'authentification obligatoire pour accéder à /auth/director/*
- Vérifier le rôle du user (director) avant de rendre la vue ou d'autoriser les endpoints API.
- CSRF : le template inclut <meta name="csrf-token"> et le formulaire de logout utilise @csrf.
- Toutes les opérations sensibles (création de PCO, publication de bulletins, actions sur utilisateurs) doivent être protégées par des policies ou gates.

## 6. Dépendances
- Backend : PHP >= 8.x, Composer, Laravel (version compatible avec le code présent)
- Frontend : Chart.js (inclus via CDN), CSS personnalisé (dans la vue)
- Base de données : MySQL / PostgreSQL / SQLite selon configuration .env

## 7. Installation locale (exemple standard Laravel)
1. Cloner le dépôt :
   git clone <repo-url>
2. Installer les dépendances Composer :
   composer install
3. Copier le fichier d'environnement et configurer :
   cp .env.example .env
   puis ajuster DB_* et autres variables
4. Générer la clé d'application :
   php artisan key:generate
5. Migrer la base de données :
   php artisan migrate --seed
6. Lancer le serveur local :
   php artisan serve

## 8. Endpoints API attendus — spécification rapide
- GET /api/director/kpis
  - Auth required (token / session)
  - Retourne : users, articles, proposals, resolution_rate

- GET /api/director/proposals/trend?days=N
  - Retourne labels (dates) et data (counts) pour un graphique linéaire

- GET /api/director/reports/trend?days=N
  - Semblable à proposals/trend, mais pour signalements

- GET /api/director/pcos
  - Liste des PCOs avec : name, email, pco_type, last_login

- POST /api/director/pcos
  - Créer un PCO (payload : name, email, pco_type)

- POST /api/director/bulletins (ou autre route)
  - Pour publier un bulletin officiel (body, title, published_by)

## 9. Tests et qualité du code
- Écrire des tests unitaires pour :
  - Calcul des KPIs (services ou queries)
  - Endpoints API (feature tests) avec différents rôles
  - Permissions et middleware

## 10. Déploiement
- Procéder via CI/CD (GitHub Actions / GitLab CI) :
  - Installer dépendances, exécuter migrations, déployer sur serveur (Forge, Vapor, Docker, etc.)
- Gérer les variables d'environnement et la configuration de la base de données.

## 11. Suggestions d'améliorations
- Externaliser le CSS vers des fichiers SASS/SCSS et utiliser mix ou Vite.
- Ajouter gestion d'assets (compilation, cache busting).
- Ajouter un composant frontend réutilisable (Vue/React/Alpine) pour la modal Create PCO et la gestion asynchrone.
- Ajouter tests E2E (Cypress / Playwright) pour le dashboard.

## 12. Contribution
- Fork -> branche feature -> PR vers main
- Respecter les conventions de code et ajouter des tests pour les nouvelles fonctionnalités

## 13. Licence
- Préciser la licence du projet (MIT, GPL, etc.) dans un fichier LICENSE si non présent.

---

Si vous souhaitez, je peux :
- Générer les contrôleurs et routes API minimales correspondant aux endpoints attendus
- Ajouter des tests d'intégration pour les endpoints
- Externaliser le CSS et préparer une compilation d'assets

Indiquez quelle tâche vous voulez prioriser.
# Gab-Echo
