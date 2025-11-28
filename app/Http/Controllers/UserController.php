<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Article;
use App\Models\Likes;
use App\Models\Comment;

class UserController extends Controller
{
    /**
     * Redirige l'utilisateur vers son dashboard principal selon son rôle.
     */
    public function dashboard()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.form');
        }

        // Récupération du nombre d'articles publiés par l'utilisateur
        $userPostsCount = $user->articles()->count();

        // Récupération du nombre de likes reçus (si la relation likes est définie dans Article)
        $likesReceivedCount = $user->articles()->withCount('likes')->get()->sum('likes_count');

        // Récupération du nombre de signalements (si la relation reportsAgainst existe dans User)
        $reportsAgainstCount = method_exists($user, 'reportsAgainst') ? $user->reportsAgainst()->count() : 0;

        $stats = [
            'user_posts' => $userPostsCount,
            'likes_received' => $likesReceivedCount,
            'reports_against' => $reportsAgainstCount,
        ];

        // Récupère tous les articles de l'utilisateur, du plus récent au plus ancien
        $articles = $user->articles()->latest()->get();

        // Passage des variables à la vue
        return view('auth.user.dashboard', compact('user', 'articles', 'stats'));
    }

    /**
     * Affiche la page de profil utilisateur.
     */
    public function showProfile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.form');
        }

        return view('auth.user.profile.show', compact('user'));
    }

    /**
     * Affiche le formulaire de modification du profil.
     */
    public function editProfile()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.form');
        }

        return view('auth.user.profile.edit', compact('user'));
    }

    /**
     * Met à jour le profil de l’utilisateur connecté.
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login.form');
        }

        $validated = $request->validate([
            'profile_photo_path' => ['nullable', 'image', 'max:2048'],
            'first_name'         => ['required', 'string', 'max:255'],
            'last_name'          => ['required', 'string', 'max:255'],
            'date_of_birth'      => ['nullable', 'date'],
            'phone_number'       => ['nullable', 'string', 'max:20', 'regex:/^[\d\s+()-]*$/'],
            'email'              => ['required', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password'           => ['nullable', 'string', 'min:8', 'confirmed'],
            'icon_color'         => ['nullable', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'background_color'   => ['nullable', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        // Gestion de la photo de profil
        if ($request->hasFile('profile_photo_path')) {
            if ($user->profile_photo_path && File::exists(public_path($user->profile_photo_path))) {
                File::delete(public_path($user->profile_photo_path));
            }

            $image = $request->file('profile_photo_path');
            $imageName = time() . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName());
            $image->move(public_path('uploads/profiles'), $imageName);
            $user->profile_photo_path = 'uploads/profiles/' . $imageName;
        }

        // Mise à jour des données utilisateur
        $user->first_name = $validated['first_name'];
        $user->last_name = $validated['last_name'];
        $user->date_of_birth = $validated['date_of_birth'] ?? null;
        $user->phone_number = $validated['phone_number'] ?? null;
        $user->email = $validated['email'];
        $user->icon_color = $validated['icon_color'] ?? null;
        $user->background_color = $validated['background_color'] ?? null;

        // Mise à jour du mot de passe uniquement si renseigné
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Redirige vers le dashboard utilisateur avec message de succès
        return redirect()->route($user->dashboardRoute())
                         ->with('success', 'Profil mis à jour avec succès.');
    }

    /**
     * Suppression logique semi-complète d'un utilisateur
     * Supprime fichiers photo, anonymise données, et soft delete.
     */
    public function softDeleteUser(User $user)
    {
        // Vérification des droits (à adapter selon ta logique)
        $currentUser = Auth::user();
        if (!$currentUser || !in_array($currentUser->role, ['super_admin', 'admin', 'director']) && $currentUser->id !== $user->id) {
            return redirect()->route('user.dashboard')->with('error', 'Accès refusé.');
        }

        // Supprimer la photo de profil physiquement si existante
        if ($user->profile_photo_path && File::exists(public_path($user->profile_photo_path))) {
            File::delete(public_path($user->profile_photo_path));
        }

        // Supprimer les images des articles de cet utilisateur
        foreach ($user->articles as $article) {
            if ($article->image && File::exists(public_path($article->image))) {
                File::delete(public_path($article->image));
            }
        }

        // Anonymisation partielle
        $user->email = 'deleted_user_' . $user->id . '@example.com';
        $user->phone_number = null;
        $user->password = null; // rend le compte inutilisable
        // Tu peux aussi anonymiser le nom si tu veux, ou le garder pour trace
        // $user->first_name = 'Utilisateur';
        // $user->last_name = 'Supprimé';

        $user->save();

        // Soft delete (avec trait SoftDeletes dans le modèle User)
        $user->delete();

        return redirect()->route('login.form')->with('success', 'Compte supprimé avec succès.');
    }
}
