<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Tableau de bord — {{ auth()->user()->name ?? 'Utilisateur' }}</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap');

        :root {
            --accent: #f53003;
            --accent-hover: #d12600;
            --bg: #f4f6f8;
            --card-bg: #ffffff;
            --text-dark: #1b1b18;
            --muted: #6b7280;
            --shadow: rgba(0, 0, 0, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            font-family: 'Inter', Arial, sans-serif;
            color: var(--text-dark);
        }

        .layout {
            display: flex;
            min-height: 100vh;
            overflow: hidden;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: #fff;
            border-right: 1px solid #e6e9eb;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 2px 0 6px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .sidebar h3 {
            margin: 0 0 1rem;
            font-size: 1.3rem;
            color: var(--accent);
            text-align: center;
        }

        .nav-links a {
            display: block;
            padding: 0.6rem 0.8rem;
            color: var(--text-dark);
            text-decoration: none;
            border-radius: 0.4rem;
            margin-bottom: 0.25rem;
            transition: background 0.25s ease, color 0.25s ease;
        }

        .nav-links a:hover {
            background: #ffe8e1;
            color: var(--accent);
        }

        .nav-links a.active {
            background: var(--accent);
            color: #fff;
            font-weight: 600;
        }

        .logout-form {
            text-align: center;
            margin-top: 1.5rem;
        }

        .btn-logout {
            padding: 0.5rem 1rem;
            background: #444;
            color: #fff;
            border-radius: 0.4rem;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-logout:hover {
            background: #000;
        }

        /* MAIN CONTENT */
        .content {
            flex: 1;
            padding: 2rem;
            position: relative;
            overflow-y: auto;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        header h1 {
            font-size: 1.8rem;
            margin: 0;
        }

        .actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn {
            padding: 0.6rem 1rem;
            border-radius: 0.4rem;
            text-decoration: none;
            font-weight: 600;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
        }

        /* CARDS & STATS */
        .card {
            background: var(--card-bg);
            border-radius: 0.6rem;
            box-shadow: 0 4px 10px var(--shadow);
            padding: 1.2rem 1.5rem;
            margin-bottom: 1.2rem;
            animation: fadeIn 0.6s ease;
        }

        .stats {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1rem;
        }

        .stat {
            flex: 1;
            background: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            padding: 1rem;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.08);
        }

        .stat h3 {
            font-size: 2rem;
            margin: 0;
            color: var(--accent);
        }

        .stat div {
            color: var(--muted);
            font-size: 0.95rem;
        }

        /* ACTIVITIES */
        ul.activities {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        ul.activities li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        ul.activities li:last-child {
            border-bottom: none;
        }

        .activities strong {
            color: var(--text-dark);
        }

        .activities small {
            color: var(--muted);
        }

        /* ANIMATION BACKGROUND */
        .background-animation {
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at 20% 20%, #ffe8e1, transparent 50%),
                        radial-gradient(circle at 80% 80%, #fff0ed, transparent 50%);
            z-index: -1;
            animation: moveBg 10s infinite alternate ease-in-out;
        }

        @keyframes moveBg {
            0% { background-position: 0% 0%; }
            100% { background-position: 100% 100%; }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 820px) {
            .layout {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #eee;
            }

            header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .stats {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="background-animation"></div>

    <div class="layout">
        <aside class="sidebar">
            <div>
                <h3>GabonÉcho</h3>
                <nav class="nav-links">
                    <a href="{{ route('user.dashboard') }}" class="active">🏠 Tableau de bord</a>
                    <a href="{{ route('articles.index') }}">📰 Mes articles</a>
                    <a href="{{ route('articles.create') }}">✍️ Publier un article</a>
                    <a href="{{ route('profile.show') }}">⚙️ Paramètres du profil</a>
                </nav>
            </div>

            <div class="logout-form">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">Déconnexion</button>
                </form>
            </div>
        </aside>

        <main class="content">
            <header>
                <div>
                    <h1>Bienvenue, {{ auth()->user()->display_name ?? auth()->user()->name ?? 'Citoyen' }} 👋</h1>
                    <p style="color:#666;margin-top:.25rem">
                        Heureux de vous revoir ! Voici votre tableau de bord personnel.
                    </p>
                </div>
                <div class="actions">
                    <a href="{{ route('articles.create') }}" class="btn btn-primary">+ Nouvel article</a>
                </div>
            </header>

            <section class="card">
                <h2>Votre activité récente</h2>
                <p>Suivez vos publications, commentaires et statistiques ici.</p>
            </section>

            <section class="stats">
                <div class="stat">
                    <h3>{{ $stats['user_posts'] ?? 0 }}</h3>
                    <div>Articles publiés</div>
                </div>
                <div class="stat">
                    <h3>{{ $stats['likes_received'] ?? 0 }}</h3>
                    <div>Likes reçus</div>
                </div>
                <div class="stat">
                    <h3>{{ $stats['reports_against'] ?? 0 }}</h3>
                    <div>Signalements</div>
                </div>
            </section>

            <section class="card" style="margin-top:1.5rem;">
                <h2>Dernières activités</h2>
                <ul class="activities">
                    @if(!empty($activities) && count($activities))
                        @foreach($activities as $act)
                            <li>
                                <div>
                                    <strong>{{ $act['title'] ?? $act['type'] }}</strong>
                                    <div style="color:#666;font-size:.9rem">
                                        {{ $act['meta'] ?? '' }}
                                    </div>
                                </div>
                                <small>{{ $act['when'] ?? '' }}</small>
                            </li>
                        @endforeach
                    @else
                        <li>Aucune activité récente.</li>
                    @endif
                </ul>
            </section>
        </main>
    </div>
</body>
</html>
