<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PcoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DirectorDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WEB ROUTES (web.php)
|---------------------------------------------------------------------------|
| Version corrigée et améliorée pour PROJET-C GABON
| - Suppression de doublons
| - Routes API internes complètes pour le dashboard directeur
| - Endpoint SSE pour streaming temps réel (dashboard-stream)
| - Routes CRUD utilisateurs / PCO cohérentes avec le front
|---------------------------------------------------------------------------|
*/

/*
|---------------------------------------------------------------------------
| 🏠 PAGE D’ACCUEIL
|---------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|---------------------------------------------------------------------------
| 📰 ARTICLES (accès réservé aux utilisateurs connectés)
|---------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles/create', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // Commentaires et réactions (corrigé : une seule route POST pour ajout de commentaire)
    Route::get('/articles/{article}/comments', [ArticleController::class, 'comments'])->name('articles.comments');
    Route::post('/articles/{article}/comments', [ArticleController::class, 'addComment'])->name('articles.comments.add');

    // Like (réaction)
    Route::post('/articles/{article}/like', [ArticleController::class, 'like'])->name('articles.like');
});

/*
|---------------------------------------------------------------------------
| 👤 AUTHENTIFICATION (Inscription, Connexion, Déconnexion)
|---------------------------------------------------------------------------
*/
// Middleware 'guest' pour protéger les pages login/register si déjà connecté
Route::middleware(['guest'])->group(function () {
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'showForm')->name('register.form');
        Route::post('/register', 'register')->name('register');
    });

    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showForm')->name('login.form');
        Route::post('/login', 'login')->name('login');
    });
});

// Route mot de passe oublié (simple view)
Route::get('/password/forgot', function () {
    return view('auth.passwords.email');
})->name('password.request');

Route::post('/password/email', function (Illuminate\Http\Request $request) {
    // Logique pour envoyer l'email de réinitialisation (implémenter dans controller si besoin)
    return back()->with('status', 'Lien de réinitialisation envoyé !');
})->name('password.email');

// Déconnexion accessible uniquement aux utilisateurs connectés
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

/*
|---------------------------------------------------------------------------
| 👨‍💼 TABLEAUX DE BORD SELON LE RÔLE (Redirection dynamique)
|---------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Route centrale — redirige automatiquement selon le rôle
    Route::get('/dashboard', function () {
        $user = Auth::user();

        switch ($user->role) {
            case 'super_admin':
                return redirect()->route('admin.dashboard');
            case 'director':
                return redirect()->route('director.dashboard');
            case 'developer':
                return redirect()->route('dashboard_developer');
            case 'security':
                return redirect()->route('dashboard_security');
            default:
                return redirect()->route('user.dashboard');
        }
    })->name('dashboard');

    // Route bulletin.update (si nécessaire côté web)
    Route::put('/bulletin/update', [PcoController::class, 'updateBulletin'])->name('bulletin.update');

    /*
    |-----------------------------------------------------------------------
    | 📊 TABLEAUX DE BORD PAR RÔLE
    |-----------------------------------------------------------------------
    */
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/admin/dashboard', [PcoController::class, 'dashboard_admin'])->name('admin.dashboard');
    Route::get('/director/dashboard', [PcoController::class, 'dashboard_director'])->name('director.dashboard');
    Route::get('/developer/dashboard', [PcoController::class, 'dashboard_developer'])->name('dashboard_developer');
    Route::get('/security/dashboard', [PcoController::class, 'dashboard_security'])->name('dashboard_security');
    Route::get('/pco/dashboard', [PcoController::class, 'dashboard'])->name('pco.dashboard');

    /*
    |-----------------------------------------------------------------------
    | 👤 PROFIL UTILISATEUR
    |-----------------------------------------------------------------------
    */
    Route::get('/profile', [UserController::class, 'showProfile'])->name('profile.show');
    Route::get('/profile/update', [UserController::class, 'editProfile'])->name('profile.edit');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
});

/*
|---------------------------------------------------------------------------
| 🎯 API INTERNES (protégées par auth) — version consolidée
|---------------------------------------------------------------------------
|
| Ces routes sont accessibles via /api/... (préfixé) et fournissent:
| - dashboard-data (GET) -> payload complet pour front
| - dashboard-stream (SSE) -> streaming temps réel (optionnel, recommandé)
| - endpoints CRUD pour users et pcos visibles par le directeur
|
*/
Route::middleware(['auth'])->prefix('api')->group(function () {

    /*
    |-----------------------------------------------------------------------
    | DIRECTOR - Dashboard (données consolidées)
    |-----------------------------------------------------------------------
    | - GET /api/director/dashboard-data
    | - GET /api/director/dashboard-stream  (SSE) -> DirectorDashboardController@streamDashboard
    */
    Route::prefix('director')->group(function () {
        // Données initiales / snapshot
        Route::get('/dashboard-data', [DirectorDashboardController::class, 'getDashboardData'])->name('api.director.dashboard.data');

        // SSE stream (EventSource) -- le controller doit retourner une réponse streamée
        Route::get('/dashboard-stream', [DirectorDashboardController::class, 'streamDashboard'])->name('api.director.dashboard.stream');

        // KPIs & trends (si besoin séparément)
        Route::get('/kpis', [PcoController::class, 'kpis'])->name('api.director.kpis');
        Route::get('/proposals/trend', [PcoController::class, 'proposalsTrend'])->name('api.director.proposals.trend');
        Route::get('/reports/trend', [PcoController::class, 'reportsTrend'])->name('api.director.reports.trend');

        // PCO endpoints (CRUD) utilisés par le front
        Route::get('/pcos', [PcoController::class, 'pcosIndex'])->name('api.director.pcos.index');
        Route::post('/pcos', [PcoController::class, 'createPco'])->name('api.director.pcos.create');
        Route::get('/pcos/{pco}', [PcoController::class, 'showPco'])->name('api.director.pcos.show');
        Route::put('/pcos/{pco}', [PcoController::class, 'updatePco'])->name('api.director.pcos.update');
        Route::delete('/pcos/{pco}', [PcoController::class, 'deletePco'])->name('api.director.pcos.delete');

        // Bulletin officiel
        Route::post('/bulletin', [PcoController::class, 'publishBulletin'])->name('api.director.bulletin.publish');
        Route::post('/bulletin/draft', [PcoController::class, 'saveBulletinDraft'])->name('api.director.bulletin.draft');

        // Audit / health endpoints
        Route::get('/audit/recent', [PcoController::class, 'auditRecent'])->name('api.director.audit.recent');
        Route::get('/health/summary', [PcoController::class, 'healthSummary'])->name('api.director.health.summary');
    });

    /*
    |-----------------------------------------------------------------------
    | UTILISATEURS (pour le dashboard directeur)
    |-----------------------------------------------------------------------
    | Fournir:
    | - GET  /api/director/users           -> liste avec état en ligne
    | - GET  /api/director/users/{user}    -> détail (pour modal édition)
    | - PUT  /api/director/users/{user}    -> modifier
    | - DELETE /api/director/users/{user}  -> supprimer
    */
    Route::prefix('director')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('api.director.users.index');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('api.director.users.show');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('api.director.users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('api.director.users.destroy');
        Route::delete('/users/{comment}', [UserController::class, 'view'])->name('comments.store');
    });




    /*
    |-----------------------------------------------------------------------
    | ARTICLES (si tu veux exposer endpoints supplémentaires côté API web)
    |-----------------------------------------------------------------------
    | (optionnel — à décommenter / adapter si nécessaire)
    */
    // Route::get('/articles/summary', [ArticleController::class, 'summary'])->name('api.articles.summary');
});

/*
|---------------------------------------------------------------------------
| 📄 PAGES LÉGALES
|---------------------------------------------------------------------------
*/
Route::view('/terms', 'terms')->name('terms');
Route::view('/privacy', 'privacy')->name('privacy');
