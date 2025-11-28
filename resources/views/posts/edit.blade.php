<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Modifier l’article — GabonÉcho</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
    <style>
        :root {
            --bg: #f9fafc;
            --panel: #ffffff;
            --accent: #00b3a4;
            --accent2: #d4af37;
            --text: #1f2937;
            --muted: #6b7280;
            --radius: 14px;
            --shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            --input-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(120deg, #f9fafc, #eaeef7);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        header {
            background: var(--panel);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 1.7rem;
            font-weight: 600;
            color: var(--text);
            margin: 0;
        }

        .back-btn {
            background: var(--accent);
            color: #fff;
            padding: 0.6rem 1.4rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 3px 8px rgba(0, 179, 164, 0.3);
        }

        .back-btn:hover {
            background: var(--accent2);
            transform: translateY(-3px);
            box-shadow: 0 8px 15px rgba(212, 175, 55, 0.4);
        }

        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 3rem 1rem;
        }

        .form-container {
            background: var(--panel);
            padding: 3rem 3.5rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 750px;
            animation: fadeIn 0.9s ease forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.98);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 2rem;
            font-weight: 600;
            font-size: 2rem;
            color: var(--text);
        }

        form {
            display: grid;
            gap: 1.5rem;
        }

        label {
            font-weight: 500;
            margin-bottom: 0.35rem;
            display: block;
            color: var(--text);
        }

        input, select, textarea {
            width: 100%;
            padding: 0.85rem 1rem;
            border: 1.5px solid #d1d5db;
            border-radius: 10px;
            font-size: 1.05rem;
            box-shadow: var(--input-shadow);
            transition: border-color 0.25s ease, box-shadow 0.25s ease;
            font-family: inherit;
            color: var(--text);
            resize: vertical;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 6px 3px rgba(0, 179, 164, 0.3);
            outline: none;
        }

        textarea {
            min-height: 220px;
        }

        img {
            border-radius: 10px;
            max-height: 180px;
            width: 100%;
            object-fit: cover;
            margin-bottom: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }

        button[type="submit"] {
            background: var(--accent);
            color: #fff;
            padding: 1rem 1.5rem;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 14px rgba(0, 179, 164, 0.35);
            margin-top: 1rem;
            align-self: center;
            max-width: 240px;
        }

        button[type="submit"]:hover {
            background: var(--accent2);
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(212, 175, 55, 0.5);
        }

        footer {
            text-align: center;
            padding: 1.5rem;
            font-size: 0.9rem;
            color: var(--muted);
            user-select: none;
            background: var(--panel);
            box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
            margin-top: auto;
        }

        /* Responsive */
        @media (max-width: 600px) {
            .form-container {
                padding: 2rem 1.5rem;
            }
            button[type="submit"] {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Modifier l’article</h1>
        <a href="{{ route('user.dashboard') }}" class="back-btn" aria-label="Retour au tableau de bord">Retour au tableau de bord</a>
    </header>

    <main>
        <div class="form-container" role="main">
            <h2>Éditez votre publication</h2>

            <form action="{{ route('articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <label for="title">Titre de l’article</label>
                <input id="title" type="text" name="title" value="{{ old('title', $article->title) }}" required autocomplete="off" />

                <label for="category">Catégorie</label>
                <select id="category" name="category" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="Technologie" {{ (old('category', $article->category) == 'Technologie') ? 'selected' : '' }}>Technologie</option>
                    <option value="Société" {{ (old('category', $article->category) == 'Société') ? 'selected' : '' }}>Société</option>
                    <option value="Sécurité" {{ (old('category', $article->category) == 'Sécurité') ? 'selected' : '' }}>Sécurité</option>
                    <option value="Politique" {{ (old('category', $article->category) == 'Politique') ? 'selected' : '' }}>Politique</option>
                    <option value="Culture" {{ (old('category', $article->category) == 'Culture') ? 'selected' : '' }}>Culture</option>
                    <option value="Économie" {{ (old('category', $article->category) == 'Économie') ? 'selected' : '' }}>Économie</option>
                </select>

                <label for="region">Région</label>
                <select id="region" name="region" required>
                    <option value="">-- Sélectionner --</option>
                    <option value="Est" {{ (old('region', $article->region) == 'Est') ? 'selected' : '' }}>Est</option>
                    <option value="Ouest" {{ (old('region', $article->region) == 'Ouest') ? 'selected' : '' }}>Ouest</option>
                    <option value="Nord" {{ (old('region', $article->region) == 'Nord') ? 'selected' : '' }}>Nord</option>
                    <option value="Sud" {{ (old('region', $article->region) == 'Sud') ? 'selected' : '' }}>Sud</option>
                </select>

                <label>Image actuelle</label>
                @if($article->image_url)
                    <img src="{{ $article->image_url }}" alt="Image de l'article : {{ $article->title }}" />
                @endif
                <input type="file" name="image" accept="image/*" aria-describedby="imageHelp" />
                <small id="imageHelp" style="color: var(--muted); font-size: 0.85rem;">Laisser vide pour conserver l’image actuelle.</small>

                <label for="content">Contenu</label>
                <textarea id="content" name="content" required>{{ old('content', $article->content) }}</textarea>

                <button type="submit">Mettre à jour l’article</button>
            </form>
        </div>
    </main>

    <footer>
        © {{ date('Y') }} GabonÉcho — Tous droits réservés.
    </footer>
</body>
</html>
