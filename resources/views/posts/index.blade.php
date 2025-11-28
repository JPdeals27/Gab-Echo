<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Articles — GabonÉcho</title>
    <style>
        body {
            font-family: Inter, Arial, sans-serif;
            margin: 0;
            padding: 2rem;
            color: #111;
            background: #f7fafc
        }

        .container {
            max-width: 900px;
            margin: 0 auto
        }

        .post {
            background: #fff;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1rem;
            box-shadow: 0 6px 18px rgba(2, 6, 23, 0.04)
        }

        a.button {
            display: inline-block;
            margin-top: .5rem;
            padding: .45rem .75rem;
            background: #1f6feb;
            color: #fff;
            border-radius: 6px;
            text-decoration: none
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Articles</h1>
        @foreach($articles as $article)
        <div class="post">
            <h2><a href="{{ route('articles.show', $article->id) }}">{{ $article->title }}</a></h2>
            <div class="meta">Par {{ $article->author->name ?? 'Anonyme' }} · {{ $article->created_at->format('d/m/Y') }}</div>
            <p>{{ Str::limit($article->excerpt ?? $article->content, 220) }}</p>
            <a class="button" href="{{ route('articles.show', $article->id) }}">Lire la suite</a>
        </div>
        @endforeach

        <div style="margin-top:1rem">{{ $articles->links() }}</div>
    </div>
</body>
</html>
