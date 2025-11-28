<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Likes;
use App\Models\Comment;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        // Récupération des 10 derniers articles avec leur auteur (relation "author")
        $articles = Article::with('author')
            ->latest()
            ->take(10)
            ->get();

        return view('home', compact('articles'));
    }
}
