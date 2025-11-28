<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Les middlewares globaux exécutés lors de chaque requête HTTP.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // Middleware de base Laravel (sécurité, gestion requêtes, etc.)
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Groupes de middlewares pour les routes web.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            // Middleware pour les routes web classiques
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,

            // Middleware de partage d'erreurs avec les vues
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,

            // Middleware CSRF
            \App\Http\Middleware\VerifyCsrfToken::class,

            // Middleware pour lier la session utilisateur à la requête
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // Middleware pour les routes API (stateless)
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Middlewares disponibles pouvant être assignés aux routes individuellement.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        // Middleware d’authentification Laravel
        'auth' => \App\Http\Middleware\Authenticate::class,

        // Middleware de redirection si non authentifié
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,

        // Middleware qui vérifie un rôle spécifique (à créer selon besoin)
        'role' => \App\Http\Middleware\RoleMiddleware::class,

        // Middleware de redirection selon rôle (celui qu’on a corrigé)
        'role.redirect' => \App\Http\Middleware\RoleRedirectMiddleware::class,

        // Middleware pour vérifier si l’utilisateur est administrateur
        'admin' => \App\Http\Middleware\AdminMiddleware::class,

        // Middleware pour vérifier si utilisateur est directeur
        'director' => \App\Http\Middleware\DirectorMiddleware::class,

        // Middleware pour vérifier si utilisateur est PCO
        'pco' => \App\Http\Middleware\PcoMiddleware::class,

        // Middleware pour vérifier si utilisateur est invité (non connecté)
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

        // Middleware pour vérifier si utilisateur est connecté
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // etc. (ajoute ici tes autres middlewares personnalisés)
    ];
}
