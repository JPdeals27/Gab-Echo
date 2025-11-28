<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PcoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DirectorDashboardController;
use App\Http\Controllers\AuthController;

Route::middleware('auth:sanctum')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD DIRECTEUR – Données globales en temps réel
    |--------------------------------------------------------------------------
    |
    | Permet au dashboard directeur de récupérer :
    |  - nombre total d’utilisateurs
    |  - utilisateurs connectés
    |  - utilisateurs PCO
    |  - nombre d’articles
    |  - activité en temps réel pour les graphes
    |  - statistiques globales
    |
    */

    Route::get('/director/dashboard-data', [DirectorDashboardController::class, 'getDashboardData']);

    /*
    |--------------------------------------------------------------------------
    | UTILISATEURS
    |--------------------------------------------------------------------------
    |
    | Liste, affichage, modification, suppression
    |
    */

    // Liste complète des utilisateurs
    Route::get('/director/users', [UserController::class, 'index']);

    // Détails d’un utilisateur
    Route::get('/director/users/{user}', [UserController::class, 'show']);

    // Modifier un utilisateur (normal, pco, admin etc.)
    Route::put('/director/users/{user}', [UserController::class, 'update']);

    // Supprimer un utilisateur
    Route::delete('/director/users/{user}', [UserController::class, 'destroy']);


    /*
    |--------------------------------------------------------------------------
    | PCO (Point de Contact Officiel)
    |--------------------------------------------------------------------------
    |
    | CRUD complet : liste, création, édition, suppression
    |
    */

    // Liste des PCO
    Route::get('/director/pcos', [PcoController::class, 'pcosIndex']);

    // Créer un PCO
    Route::post('/director/pcos', [PcoController::class, 'createPco']);

    // Détails d’un PCO
    Route::get('/director/pcos/{pco}', [PcoController::class, 'showPco']);

    // Mise à jour d’un PCO
    Route::put('/director/pcos/{pco}', [PcoController::class, 'updatePco']);

    // Suppression d’un PCO
    Route::delete('/director/pcos/{pco}', [PcoController::class, 'deletePco']);


    /*
    |--------------------------------------------------------------------------
    | BULLETIN OFFICIEL
    |--------------------------------------------------------------------------
    */

    Route::post('/director/bulletin', [DirectorDashboardController::class, 'publishBulletin']);
    Route::post('/director/bulletin/draft', [DirectorDashboardController::class, 'saveBulletinDraft']);
});


/*
|--------------------------------------------------------------------------
| AUTH – Connexion / Déconnexion / Vérification
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
