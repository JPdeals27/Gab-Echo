<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleRedirectMiddleware
{
    /**
     * Gère la redirection selon le rôle de l'utilisateur.
     *
     * Ce middleware est destiné à être utilisé sur les routes publiques
     * comme la page de connexion ou d'inscription.
     * 
     * S'il y a un utilisateur connecté, il sera redirigé vers son tableau de bord.
     * Sinon, la requête continue normalement.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): \Illuminate\Http\Response  $next
     * @return \Illuminate\Http\Response
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user) {
            // Redirection dynamique selon le rôle
            switch ($user->role) {
                case 'super_admin':
                    return redirect()->route('admin.dashboard');
                case 'director':
                    return redirect()->route('director.dashboard');
                case 'developer':
                    return redirect()->route('developer.dashboard');
                case 'security':
                    return redirect()->route('security.dashboard');
                default:
                    return redirect()->route('user.dashboard');
            }
        }

        // Pas d'utilisateur connecté, on laisse passer la requête
        return $next($request);
    }
}
