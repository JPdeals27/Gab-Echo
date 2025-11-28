<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>Tableau de bord — {{ auth()->user()->name ?? 'Utilisateur' }}</title>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

            :root {
                --accent: {{ auth()->user()->icon_color ?? '#0a9396' }};
                --accent-light: #b2e0de;
                --accent-hover: {{ auth()->user()->icon_color ?? '#0a9396' }};
                --bg: {{ auth()->user()->background_color ?? '#f9fafb' }};
                --card-bg: #fff;
                --text-dark: #222;
                --muted: #6c757d;
                --shadow-light: rgba(0, 0, 0, 0.06);
                --shadow-heavy: rgba(0, 0, 0, 0.15);
                --border-radius: 0.75rem;
                --transition-fast: 0.25s ease;
                --transition-medium: 0.4s ease;
            }

            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                font-family: 'Inter', Arial, sans-serif;
            }

            body {
                background-color: var(--bg);
                color: var(--text-dark);
                min-height: 100vh;
                overflow-x: hidden;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
            }

            .layout {
                display: grid;
                grid-template-columns: 280px 1fr;
                grid-template-rows: 100vh;
                gap: 0;
                overflow: hidden;
            }

            .sidebar {
                width: 270px;
                background: #fafafa;
                border-right: 1px solid #e6e9eb;
                padding: 2rem 1.5rem;
                display: flex;
                flex-direction: column;
                justify-content: space-between;  /* C’est ce qui pousse le form en bas */
                box-shadow: 2px 0 6px rgba(0, 0, 0, 0.04);
                transition: transform 0.3s ease;
            }



            .sidebar:hover {
                background-color: var(--accent-light);
            }

            .sidebar h3 {
                font-weight: 700;
                font-size: 1.8rem;
                color: var(--accent);
                text-align: center;
                margin-bottom: 2rem;
                letter-spacing: 1.2px;
                user-select: none;
            }

            .profile-pic-container {
                display: flex;
                justify-content: center;
                margin-bottom: 2.8rem;
                user-select: none;
            }

            .profile-pic-container img {
                width: 120px;
                height: 120px;
                object-fit: cover;
                border-radius: 50%;
                border: 4px solid var(--accent);
                box-shadow: 0 6px 18px var(--accent-light);
                transition: box-shadow var(--transition-fast);
                cursor: pointer;
            }

            .profile-pic-container img:hover {
                box-shadow: 0 10px 30px var(--accent-hover);
            }

            .nav-links {
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                gap: 1.3rem;
            }

            .nav-links a {
                display: block;
                padding: 0.7rem 1rem;
                font-weight: 600;
                font-size: 1.1rem;
                color: var(--text-dark);
                text-decoration: none;
                border-radius: var(--border-radius);
                box-shadow: inset 0 0 0 0 var(--accent);
                transition: background-color var(--transition-fast), color var(--transition-fast), box-shadow var(--transition-fast);
                user-select: none;
            }

            .nav-links a:hover {
                background-color: var(--accent);
                color: white;
                box-shadow: inset 200px 0 0 0 var(--accent);
                transform: translateX(6px);
            }

            .nav-links a.active {
                background-color: var(--accent);
                color: #fff;
                font-weight: 700;
                box-shadow: 0 4px 20px var(--accent-hover);
                transform: translateX(6px);
            }

            .logout-form {
                margin-top: 3rem;
                text-align: center;
                font-size: 0.95rem;
                color: var(--muted);
                user-select: none;
            }

            .logout-form strong {
                display: block;
                margin: 0.3rem 0 0.8rem;
                font-weight: 700;
                color: var(--text-dark);
            }

            .btn-logout {
                padding: 0.75rem 1.6rem;
                border-radius: var(--border-radius);
                background: #dc3545;
                color: white;
                font-weight: 700;
                font-size: 1.1rem;
                border: none;
                cursor: pointer;
                transition: background-color var(--transition-fast), box-shadow var(--transition-fast);
                box-shadow: 0 5px 15px rgba(220, 53, 69, 0.4);
                user-select: none;
            }

            .btn-logout:hover {
                background-color: #b02a37;
                box-shadow: 0 8px 24px rgba(176, 42, 55, 0.6);
            }

            /* MAIN CONTENT */
            .content {
                padding: 3rem 4rem 4rem;
                background: var(--bg);
                overflow-y: auto;
                display: flex;
                flex-direction: column;
                gap: 3.5rem;
                min-height: 100vh;
            }

            /* HEADER */
            header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 1.6rem;
            }

            header > div:first-child h1 {
                font-size: 2.4rem;
                font-weight: 900;
                color: var(--accent);
                user-select: none;
            }

            header > div:first-child p {
                font-size: 1.15rem;
                color: var(--muted);
                max-width: 440px;
                user-select: text;
            }

            .actions {
                display: flex;
                gap: 1.25rem;
            }

            /* BUTTONS */
            .btn {
                border-radius: var(--border-radius);
                font-weight: 700;
                font-size: 1.15rem;
                padding: 0.85rem 1.75rem;
                user-select: none;
                cursor: pointer;
                transition: background-color var(--transition-medium), transform 0.3s ease;
                border: none;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                box-shadow: 0 6px 14px rgba(0, 0, 0, 0.06);
            }

            .btn-primary {
                background-color: var(--accent);
                color: white;
                box-shadow: 0 8px 25px rgba(245, 48, 3, 0.5);
                transform: translateY(-2px);
                text-decoration: none;
            }

            .btn-primary:hover {
                background-color: var(--accent-hover);
                transform: translateY(-4px);
                box-shadow: 0 12px 35px rgba(209, 38, 0, 0.7);
            }

            .btn-danger {
                background-color: #dc3545;
                color: white;
                box-shadow: 0 6px 14px rgba(220, 53, 69, 0.5);
            }

            .btn-danger:hover {
                background-color: #b02a37;
                transform: translateY(-3px);
                box-shadow: 0 9px 30px rgba(176, 42, 55, 0.6);
            }
            /* FIN PREMIÈRE PARTIE */
            /* CARDS & STATISTIQUES */
            .card {
                background: var(--card-bg);
                border-radius: var(--border-radius);
                box-shadow: 0 12px 28px var(--shadow-heavy);
                padding: 2.5rem 3rem;
                transition: box-shadow var(--transition-fast);
                user-select: none;
            }

            .card:hover {
                box-shadow: 0 20px 40px var(--shadow-heavy);
            }

            .card h2 {
                margin-bottom: 1.8rem;
                font-weight: 800;
                color: var(--accent);
                font-size: 1.9rem;
                user-select: text;
            }

            /* Statistiques disposition en grille */
            .stats {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 1.7rem;
            }

            /* Carte statistique individuelle */
            .stat {
                background: var(--accent-light);
                border-radius: var(--border-radius);
                padding: 2rem 1.8rem;
                text-align: center;
                box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
                cursor: default;
                transition: transform var(--transition-fast), box-shadow var(--transition-fast);
                user-select: none;
                color: var(--accent);
            }

            .stat:hover {
                transform: translateY(-6px);
                box-shadow: 0 18px 40px rgba(0, 0, 0, 0.15);
            }

            .stat h3 {
                font-size: 3rem;
                margin-bottom: 0.4rem;
                font-weight: 900;
                user-select: text;
            }

            .stat div {
                font-size: 1.2rem;
                font-weight: 600;
                color: var(--accent-hover);
                user-select: text;
            }

            /* ACTIVITÉS RÉCENTES */
            .activities {
                list-style: none;
                padding: 0;
                margin: 0;
                max-height: 280px;
                overflow-y: auto;
                border-radius: var(--border-radius);
                box-shadow: inset 0 0 6px var(--shadow-light);
                background: #fff;
                user-select: none;
            }

            .activities li {
                padding: 1rem 1.5rem;
                border-bottom: 1px solid #e7e7e7;
                display: flex;
                justify-content: space-between;
                align-items: center;
                font-size: 1.05rem;
                color: var(--text-dark);
                transition: background-color var(--transition-fast);
            }

            .activities li:last-child {
                border-bottom: none;
            }

            .activities li:hover {
                background-color: var(--accent-light);
            }

            .activities strong {
                color: var(--accent-hover);
                user-select: text;
            }

            .activities small {
                color: var(--muted);
                font-size: 0.9rem;
                font-style: italic;
            }

            /* ARTICLES - Grille plus dynamique */
            .articles-grid {
                display: grid;
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                gap: 1.8rem;
            }

            /* Carte article */
            .article-card {
                background: var(--card-bg);
                border-radius: var(--border-radius);
                box-shadow: 0 8px 28px var(--shadow-light);
                overflow: hidden;
                display: flex;
                flex-direction: column;
                cursor: pointer;
                transition: transform var(--transition-fast), box-shadow var(--transition-fast);
                user-select: none;
            }

            .article-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 18px 50px var(--shadow-heavy);
            }

            .article-card img {
                width: 100%;
                height: 170px;
                object-fit: cover;
                transition: transform var(--transition-fast);
                user-select: none;
            }

            .article-card:hover img {
                transform: scale(1.1);
            }

            .article-card .info {
                padding: 1.5rem 1.8rem;
                flex-grow: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .article-card h4 {
                margin-bottom: 0.6rem;
                color: var(--accent);
                font-weight: 800;
                font-size: 1.3rem;
                line-height: 1.2;
                user-select: text;
            }

            .article-card p {
                flex-grow: 1;
                font-size: 1rem;
                color: #555;
                line-height: 1.4;
                user-select: text;
                margin-bottom: 1.1rem;
            }

            .article-card small {
                color: var(--muted);
                font-size: 0.9rem;
                font-style: italic;
                user-select: text;
            }

            /* Boutons d’actions article */
            .article-actions {
                background: var(--accent-light);
                padding: 1rem 1.5rem;
                border-top: 1px solid #e0e0e0;
                display: flex;
                justify-content: flex-end;
                gap: 1rem;
            }

            .btn-edit, .btn-delete {
                border-radius: 0.5rem;
                padding: 0.5rem 1.1rem;
                font-weight: 700;
                font-size: 0.95rem;
                border: none;
                cursor: pointer;
                transition: background-color var(--transition-fast);
                user-select: none;
            }

            .btn-edit {
                background-color: var(--accent);
                color: #fff;
            }

            .btn-edit:hover {
                background-color: var(--accent-hover);
            }

            .btn-delete {
                background-color: #dc3545;
                color: #fff;
            }

            .btn-delete:hover {
                background-color: #b02a37;
            }

            /* MODALES */
            .modal {
                display: none;
                position: fixed;
                z-index: 9999;
                top: 0; left: 0;
                width: 100vw;
                height: 100vh;
                background: rgba(0,0,0,0.55);
                justify-content: center;
                align-items: center;
                padding: 2rem;
                overflow-y: auto;
                user-select: none;
            }

            .modal.active {
                display: flex;
            }

            .modal-content {
                background: var(--card-bg);
                border-radius: var(--border-radius);
                max-width: 700px;
                width: 100%;
                padding: 2rem 2.5rem;
                box-shadow: 0 12px 36px var(--shadow-heavy);
                position: relative;
                animation: fadeInModal 0.4s ease forwards;
                max-height: 90vh;
                overflow-y: auto;
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .modal-content img {
                max-width: 100%;
                max-height: 75vh;
                object-fit: contain;
                border-radius: 0.5rem;
                margin-bottom: 1.5rem;
                user-select: none;
            }

            .modal-close {
                position: absolute;
                top: 1.2rem;
                right: 1.2rem;
                background: transparent;
                border: none;
                font-size: 1.7rem;
                cursor: pointer;
                color: var(--accent);
                font-weight: 700;
                transition: color var(--transition-fast);
                user-select: none;
            }

            .modal-close:hover {
                color: var(--accent-hover);
            }

            .modal-content h2 {
                margin-bottom: 1rem;
                color: var(--accent);
                font-weight: 900;
            }

            .article-description {
                background: #f4f7f8;
                border-radius: 0.5rem;
                padding: 1.5rem 1.8rem;
                box-shadow: inset 0 0 12px rgba(0,0,0,0.07);
                color: var(--text-dark);
                width: 100%;
                max-width: 600px;
                user-select: text;
                font-size: 1.1rem;
                line-height: 1.6;
                white-space: pre-line;
            }

            .article-description h2 {
                margin-top: 0;
                margin-bottom: 1rem;
                font-weight: 700;
                font-size: 1.8rem;
            }

            /* Boutons modales */
            .modal-buttons {
                margin-top: 2rem;
                display: flex;
                justify-content: center;
                gap: 1.2rem;
                width: 100%;
                max-width: 400px;
            }

            .modal-buttons button {
                padding: 0.75rem 1.7rem;
                border-radius: var(--border-radius);
                font-weight: 700;
                font-size: 1rem;
                border: none;
                cursor: pointer;
                user-select: none;
                transition: background-color var(--transition-fast);
            }

            .btn-cancel {
                background-color: #6c757d;
                color: white;
            }

            .btn-cancel:hover {
                background-color: #5a6268;
            }

            .btn-confirm {
                background-color: #dc3545;
                color: white;
            }

            .btn-confirm:hover {
                background-color: #b02a37;
            }

            /* ANIMATIONS */
            @keyframes fadeInModal {
                from { opacity: 0; transform: translateY(15px); }
                to { opacity: 1; transform: translateY(0); }
            }

            /* RESPONSIVE */
            @media (max-width: 900px) {
                .layout {
                    grid-template-columns: 1fr;
                    grid-template-rows: auto auto;
                }

                .sidebar {
                    width: 100%;
                    flex-direction: row;
                    padding: 1.5rem 2rem;
                    border-right: none;
                    border-bottom: 1px solid #e1e8ed;
                    overflow-x: auto;
                }

                .sidebar:hover {
                    background-color: #fff;
                }

                .nav-links {
                    flex-direction: row;
                    gap: 1rem;
                    overflow-x: auto;
                    white-space: nowrap;
                    align-items: center;
                }

                .profile-pic-container {
                    margin: 0 1.5rem 0 0;
                }

                .content {
                    padding: 2rem 2rem 3rem;
                }

                header {
                    flex-direction: column;
                    align-items: flex-start;
                    gap: 1rem;
                }

                .stats {
                    grid-template-columns: 1fr;
                }

                .articles-grid {
                    grid-template-columns: 1fr;
                }
            }


        </style>
    </head>

   <body>
    <div class="layout">
        <!-- SIDEBAR -->
        <aside class="sidebar">
            <div>
                <h3>GabonÉcho</h3>

                <div class="profile-pic-container">
                    <img src="{{ auth()->user()->profile_photo_url }}" alt="Photo de profil" class="profile-pic">
                </div>

                <div class="nav-links">
                    <a href="{{ route('home') }}" class="active">🏠 Accueil</a>
                    <a href="{{ route('articles.create') }}">📝 Ajouter un article</a>
                    <a href="{{ route('profile.edit') }}">⚙️ Modifier le profil</a>
                </div>
            </div>

            <form class="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <div>
                    Connecté en tant que<br>
                    <strong>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</strong>
                </div>
                <hr>
                <br>
                <button type="submit" class="btn-logout">Déconnexion</button>
            </form>
        </aside>

        <!-- CONTENU PRINCIPAL -->
        <main class="content">
            <header>
                <div>
                    <h1>Bienvenue, {{ Auth::user()->first_name }}</h1>
                    <p>Voici votre espace personnel où vous pouvez suivre vos activités, vos statistiques et vos articles publiés.</p>
                </div>

                <div class="actions">
                    <a href="{{ route('articles.create') }}" class="btn btn-primary">➕ Ajouter un article</a>
                </div>
            </header>

            @if(session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            <!-- STATISTIQUES -->
            <section class="card">
                <h2>Vos statistiques</h2>
                <div class="stats">
                    <div class="stat" title="Nombre d'articles que vous avez publiés">
                        <h3>{{ $stats['user_posts'] ?? 0 }}</h3>
                        <div>Articles publiés</div>
                    </div>
                    <div class="stat" title="Nombre total de likes reçus sur vos articles">
                        <h3>{{ $stats['likes_received'] ?? 0 }}</h3>
                        <div>Likes reçus</div>
                    </div>
                    <div class="stat" title="Nombre total de commentaires reçus sur vos articles">
                        <h3>{{ $stats['comments_received'] ?? 0 }}</h3>
                        <div>Commentaires reçus</div>
                    </div>
                </div>
            </section>

            <!-- ACTIVITÉS RÉCENTES -->
            <section class="card">
                <h2>Activités récentes</h2>
                @if(!empty($activities) && count($activities) > 0)
                    <ul class="activities">
                        @foreach($activities as $activity)
                            <li>
                                <strong>{{ $activity['action'] }}</strong>
                                <small>{{ $activity['time'] }}</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>Aucune activité récente pour le moment.</p>
                @endif
            </section>

            <!-- ARTICLES -->
            <section class="card">
                <h2>Vos articles</h2>

                @if($articles->isEmpty())
                    <p>Vous n’avez encore publié aucun article. Commencez par en créer un !</p>
                @else
                    <div class="articles-grid">
                        @foreach($articles as $article)
                            <div class="article-card" onclick="openModal({{ $article->id }})" style="cursor:pointer; background-color: {{ $article->background_color ?? '#fff' }};">
                                <img src="{{ asset($article->image ?? 'default-article.jpg') }}" alt="Image de l’article">
                                <div class="info">
                                    <h4>{{ $article->title }}</h4>
                                    <p>{{ Str::limit($article->content, 80) }}</p>
                                    <small>Publié le {{ $article->created_at->format('d/m/Y') }}</small>
                                </div>

                                <div class="article-actions">
                                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-edit" onclick="event.stopPropagation();">Modifier</a>

                                    <button class="btn btn-delete" onclick="event.stopPropagation(); openDeleteModal({{ $article->id }}, '{{ addslashes($article->title) }}')">Supprimer</button>
                                </div>
                            </div>

                            <!-- Modale individuelle -->
                            <div id="modal-{{ $article->id }}" class="modal">
                                <div class="modal-content" style="background-color: {{ $article->background_color ?? '#fff' }};">
                                    <button class="modal-close" onclick="closeModal({{ $article->id }})">&times;</button>
                                    <img src="{{ asset($article->image ?? 'default-article.jpg') }}" alt="Image article">
                                    <h2>{{ $article->title }}</h2>
                                    <p>{{ $article->content }}</p>
                                    <small>Publié le {{ $article->created_at->format('d/m/Y à H:i') }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </section>

        </main>
    </div>

    <!-- MODALE DE CONFIRMATION SUPPRESSION -->
    <div id="delete-modal" class="modal">
        <div class="modal-content">
            <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
            <h2>Confirmer la suppression</h2>
            <p id="delete-modal-text">Êtes-vous sûr de vouloir supprimer cet article ? Cette action est irréversible.</p>
            <div class="modal-buttons">
                <button class="btn-cancel" onclick="closeDeleteModal()">Annuler</button>
                <form id="delete-form" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-confirm">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Ouvrir le modal de lecture article
        function openModal(id) {
            document.getElementById('modal-' + id).classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        // Fermer le modal de lecture article
        function closeModal(id) {
            document.getElementById('modal-' + id).classList.remove('active');
            document.body.style.overflow = 'auto';
        }

        // Fermer le modal de lecture en cliquant à l’extérieur
        window.onclick = function(e) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (e.target === modal) {
                    modal.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }
            });
        }

        // --- Modal de confirmation suppression ---

        const deleteModal = document.getElementById('delete-modal');
        const deleteModalText = document.getElementById('delete-modal-text');
        const deleteForm = document.getElementById('delete-form');

        // Ouvrir la modale de suppression avec titre et action dynamique
        function openDeleteModal(articleId, articleTitle) {
            deleteModal.classList.add('active');
            document.body.style.overflow = 'hidden';
            deleteModalText.textContent = `Êtes-vous sûr de vouloir supprimer l'article "${articleTitle}" ? Cette action est irréversible.`;

            // Mettre à jour l'URL du formulaire de suppression
            deleteForm.action = `/articles/${articleId}`;
        }

        // Fermer la modale de suppression
        function closeDeleteModal() {
            deleteModal.classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    </script>
</body>
</html>
