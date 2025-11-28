<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Likes;
use App\Models\Comment;
use App\Models\User;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'category',
        'region',
        'image',
        'anonymous',
        'background_color',
        'icon_color',
    ];

    protected $casts = [
        'anonymous' => 'boolean',
    ];

    // Relation vers l'auteur (User)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation vers les commentaires
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Relation vers les likes
    public function likes()
    {
        return $this->hasMany(Likes::class);
    }

    /**
     * Récupère le nombre de commentaires
     */
    public function commentsCount()
    {
        return $this->comments()->count();
    }

    /**
     * Récupère le nombre de likes
     */
    public function likesCount()
    {
        return $this->likes()->count();
    }

    /**
     * Scope pour les articles anonymes ou non
     */
    public function scopeAnonymous($query, $value = true)
    {
        return $query->where('anonymous', $value);
    }
}
