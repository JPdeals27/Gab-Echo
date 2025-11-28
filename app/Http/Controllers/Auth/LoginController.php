<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Affiche le formulaire de connexion
     */
    public function showForm()
    {
        return view('auth.login');
    }

    /**
     * Déconnecte l’utilisateur et détruit la session
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Déconnecte l’utilisateur

        $request->session()->invalidate();       // Invalide la session courante
        $request->session()->regenerateToken();  // Regénère le token CSRF

        return redirect('/'); // Redirige vers la page d’accueil
    }

    /**
     * Authentifie un utilisateur et le redirige selon son rôle
     */
    public function login(Request $request)
    {
        // Validation des données reçues
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Tente d’authentifier l’utilisateur
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Routes des rôles particuliers
            $routes = [
                'super_admin' => 'admin.dashboard',
                'admin'       => 'admin.dashboard',
                'director'    => 'director.dashboard',
                'developer'   => 'pco.dashboard',
                'security'    => 'pco.dashboard',
            ];

            // Si rôle absent ou non défini, redirection vers user.dashboard
            $targetRoute = $user->role && isset($routes[$user->role]) ? $routes[$user->role] : 'user.dashboard';

            return redirect()->route($targetRoute);
        }

        // Identifiants incorrects
        return back()->withErrors([
            'email' => 'Identifiants incorrects.',
        ])->onlyInput('email');
    }

    /**
     * (Optionnel) Méthode de redirection par défaut si utilisée ailleurs
     */
    protected function redirectTo()
    {
        $user = auth()->user();

        $routes = [
            'super_admin' => '/admin/dashboard',
            'admin'       => '/admin/dashboard',
            'director'    => '/director/dashboard',
            'developer'   => '/pco/dashboard',
            'security'    => '/pco/dashboard',
        ];

        return $user->role && isset($routes[$user->role]) ? $routes[$user->role] : '/user/dashboard';
    }
}
