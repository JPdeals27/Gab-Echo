<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un article — GabonÉcho</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
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
        }

        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f9fafc, #eef2f9);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .06);
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-size: 1.5rem;
            color: var(--text);
            font-weight: 600;
        }

        .back-btn {
            background: var(--accent);
            color: #fff;
            padding: .6rem 1.2rem;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all .3s ease;
        }

        .back-btn:hover {
            background: var(--accent2);
            transform: translateY(-3px);
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
            padding: 2.5rem 3rem;
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 750px;
            animation: slideUp 0.8s ease forwards;
        }

        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        h2 {
            text-align: center;
            margin-bottom: 1.8rem;
            color: var(--text);
        }

        form {
            display: grid;
            gap: 1.2rem;
        }

        input, select, textarea {
            width: 100%;
            padding: .75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            font-size: 1rem;
            transition: all .2s ease;
        }

        input:focus, textarea:focus, select:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(0, 179, 164, 0.15);
            outline: none;
        }

        textarea {
            min-height: 200px;
            resize: vertical;
        }

        button {
            background: var(--accent);
            color: #fff;
            padding: .9rem 1.2rem;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all .3s ease;
        }

        button:hover {
            background: var(--accent2);
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        }

        footer {
            text-align: center;
            padding: 1.2rem;
            font-size: .9rem;
            color: var(--muted);
        }
    </style>
</head>
<body>
    <header>
        <h1>Créer un article</h1>
        <a href="{{ route('user.dashboard') }}" class="back-btn">Retour au tableau de bord</a>
    </header>

    <main>
        <div class="form-container">
            <h2>Publiez votre article</h2>

            <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label>Titre de l’article</label>
                <input type="text" name="title" placeholder="Entrez le titre de votre article" required>

                <label>Catégorie</label>
                <select name="category">
                    <option value="Technologie">Technologie</option>
                    <option value="Société">Société</option>
                    <option value="Sécurité">Sécurité</option>
                    <option value="Politique">Politique</option>
                    <option value="Culture">Culture</option>
                    <option value="Économie">Économie</option>
                </select>

                <label>Image de couverture</label>
                <input type="file" name="image" accept="image/*">

                <label>Contenu</label>
                <textarea name="content" placeholder="Rédigez votre article ici..." required></textarea>

                <button type="submit">Publier l’article</button>
            </form>
        </div>
    </main>

    <footer>
        © {{ date('Y') }} GabonÉcho — Tous droits réservés.
    </footer>
</body>
</html>
