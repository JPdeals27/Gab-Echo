<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\Comment;
use App\Models\User;
use App\Models\Like; // Correction ici : le modèle s'appelle Like, pas Likes

class ArticleController extends Controller
{
    public function create()
    {
        return view('posts.create'); // ou 'articles.create' selon ta structure
    }

    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('posts.index', compact('articles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'content'          => 'required|string',
            'category'         => 'nullable|string|max:100',
            'region'           => 'nullable|string|max:100',
            'image'            => 'nullable|image|max:2048',
            'anonymous'        => 'nullable|boolean',
            'background_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'icon_color'       => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        $article = new Article($validated);
        $article->user_id = Auth::id();
        $article->anonymous = $request->boolean('anonymous', false);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName());
            $image->move(public_path('articles'), $imageName);
            $article->image = 'articles/' . $imageName;
        }

        $article->save();

        return redirect()->route('user.dashboard')
                         ->with('success', 'Article publié avec succès !');
    }

    public function update(Request $request, Article $article)
    {
        // Permettre aux PCOs de modifier aussi (avec vérification)
        $user = Auth::user();

        if ($article->user_id !== $user->id && !in_array($user->role, ['super_admin', 'admin', 'director'])) {
            return redirect()->route('articles.index')->with('error', 'Accès refusé.');
        }

        $validated = $request->validate([
            'title'            => 'required|string|max:255',
            'content'          => 'required|string',
            'category'         => 'nullable|string|max:100',
            'region'           => 'nullable|string|max:100',
            'image'            => 'nullable|image|max:2048',
            'anonymous'        => 'nullable|boolean',
            'background_color' => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'icon_color'       => ['nullable', 'regex:/^#[0-9A-Fa-f]{6}$/'],
        ]);

        $article->fill($validated);
        $article->anonymous = $request->boolean('anonymous', false);

        if ($request->hasFile('image')) {
            // Supprime l'ancienne image si elle existe
            if ($article->image && File::exists(public_path($article->image))) {
                File::delete(public_path($article->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName());
            $image->move(public_path('articles'), $imageName);
            $article->image = 'articles/' . $imageName;
        }

        $article->save();

        return redirect()->route('user.dashboard')->with('success', 'Article mis à jour avec succès.');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Autres méthodes éventuelles ...

    public function destroy(Article $article)
    {
        $user = Auth::user();

        if ($article->user_id !== $user->id && !in_array($user->role, ['super_admin', 'admin', 'director'])) {
            return redirect()->route('articles.index')->with('error', 'Accès refusé.');
        }

        // Supprime le fichier image lié à l'article, si présent
        if ($article->image && File::exists(public_path($article->image))) {
            File::delete(public_path($article->image));
        }

        $article->delete();

        return redirect()->route('user.dashboard')->with('success', 'Article supprimé avec succès.');
    }

    public function edit(Article $article)
    {
        $user = Auth::user();

        if ($article->user_id !== $user->id && !in_array($user->role, ['super_admin', 'admin', 'director'])) {
            return redirect()->route('articles.index')->with('error', 'Accès refusé.');
        }

        return view('posts.edit', compact('article'));
    }
}
