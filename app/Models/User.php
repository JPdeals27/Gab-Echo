<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use App\Models\Like;
use App\Models\Article;
use App\Models\Comment;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Champs pouvant être remplis en masse
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'province',
        'gender',
        'phone_number',
        'email',
        'password',
        'profile_photo_path',
        'icon_color',
        'background_color',
        'role',
    ];

    /**
     * Champs cachés dans les sérialisations
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Caster automatiquement les attributs
     */
    protected $casts = [
        'date_of_birth' => 'date',
    ];

    /**
     * 🔗 Relation : un utilisateur peut avoir plusieurs articles
     */
    public function articles()
    {
        return $this->hasMany(\App\Models\Article::class, 'user_id');
    }

    /**
     * Relation vers les commentaires faits par l'utilisateur
     */
    public function comments()
    {
        return $this->hasMany(\App\Models\Comment::class, 'user_id');
    }

    /**
     * Relation vers les likes faits par l'utilisateur
     */
    public function likes()
    {
        return $this->hasMany(\App\Models\Like::class, 'user_id');
    }

    /**
     * Relation pour récupérer tous les likes reçus sur les articles de cet utilisateur
     */
    public function receivedLikes()
    {
        return $this->hasManyThrough(
            Like::class,
            Article::class,
            'user_id',   // Foreign key on Article table...
            'article_id',// Foreign key on Like table...
            'id',        // Local key on User table...
            'id'         // Local key on Article table...
        );
    }

    /**
     * Retourne l'URL complète de la photo de profil, ou une image par défaut
     */
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo_path && Storage::disk('public')->exists($this->profile_photo_path)) {
            return asset('storage/' . $this->profile_photo_url);
        }

        // Retourne une image SVG ou PNG stylisée par défaut dans public/uploads/images
        return asset('uploads/images/default-profile.png');
    }


    /**
     * Vérifie si l'utilisateur est un PCO (rôles particuliers)
     */
    public function isPco(): bool
    {
        return in_array($this->role, ['super_admin', 'director', 'admin', 'developer', 'security']);
    }

    /**
     * Vérifie si l'utilisateur est admin
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, ['super_admin', 'admin']);
    }

    /**
     * Vérifie si l'utilisateur est un simple utilisateur lambda (sans rôle)
     */
    public function isUser(): bool
    {
        return empty($this->role) || $this->role === 'user';
    }

    /**
     * Retourne la route du dashboard selon le rôle
     */
    public function dashboardRoute(): string
    {
        $routes = [
            'super_admin' => 'admin.dashboard',
            'admin'       => 'admin.dashboard',
            'director'    => 'director.dashboard',
            'developer'   => 'pco.dashboard',
            'security'    => 'pco.dashboard',
            'user'        => 'user.dashboard',
        ];

        // Par défaut, redirige vers 'user.dashboard' si aucun rôle ou rôle inconnu
        return $routes[$this->role] ?? 'user.dashboard';
    }

    /**
     * Récupère le nombre total d'articles de l'utilisateur
     */
    public function articlesCount(): int
    {
        return $this->articles()->count();
    }

    /**
     * Récupère le nombre total de commentaires reçus sur ses articles
     */
    public function commentsReceivedCount(): int
    {
        return $this->articles()->withCount('comments')->get()->sum('comments_count');
    }

    /**
     * Récupère le nombre total de likes reçus sur ses articles
     */
    public function likesReceivedCount(): int
    {
        return $this->receivedLikes()->count();
    }
}
