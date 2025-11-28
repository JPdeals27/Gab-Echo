<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GabonÉcho — Tableau de bord Directeur</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />

    <style>
        /* Styles (inchangés) */
        :root {
            --bg-dark: #0a1a0b;
            --bg-gradient: linear-gradient(135deg, #0f2a15 0%, #04140a 100%);
            --panel-bg: rgba(15, 42, 21, 0.85);
            --glass-bg: rgba(255, 255, 255, 0.06);
            --accent-green: #29d67a;
            --accent-green-dark: #1eb65c;
            --accent-gold: #ffd35c;
            --text-light: #e9f3ea;
            --text-muted: #9fb4c8;
            --border-color: rgba(255, 255, 255, 0.12);
            --radius: 14px;
            --shadow-glass: 0 8px 32px 0 rgba(40, 199, 111, 0.25);
            --font-family: 'Inter', Arial, sans-serif;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: var(--font-family);
            background: var(--bg-gradient);
            color: var(--text-light);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-y: scroll;
        }

        .container {
            max-width: 1280px;
            margin: 2rem auto;
            padding: 1rem 1.5rem;
        }

        /* === Top bar & Branding === */
        header.topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .brand .logo {
            width: 56px;
            height: 56px;
            border-radius: var(--radius);
            background: var(--accent-green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 26px;
            color: #04240c;
            box-shadow: var(--shadow-glass);
            user-select: none;
        }

        .brand h1 {
            font-size: 22px;
            font-weight: 700;
            margin: 0;
            line-height: 1.1;
            color: var(--text-light);
            user-select: none;
        }

        .brand .subtitle {
            font-size: 14px;
            color: var(--text-muted);
            user-select: none;
        }

        /* === Actions === */
        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        button.btn,
        a.btn {
            background-color: var(--accent-green);
            border: none;
            padding: 10px 18px;
            border-radius: var(--radius);
            color: #04240c;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(40, 199, 111, 0.5);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            white-space: nowrap;
            user-select: none;
        }

        button.btn:hover,
        a.btn:hover {
            background-color: var(--accent-green-dark);
            box-shadow: 0 6px 18px rgba(40, 199, 111, 0.75);
        }

        button.btn.alt,
        a.btn.alt {
            background: transparent;
            border: 1.5px solid var(--text-muted);
            color: var(--text-muted);
            box-shadow: none;
        }

        button.btn.alt:hover,
        a.btn.alt:hover {
            background: var(--glass-bg);
            border-color: var(--accent-green);
            color: var(--accent-green);
            box-shadow: var(--shadow-glass);
        }

        /* Bouton logout */
        form.logout-form button.btn-logout {
            background-color: #d64933;
            color: #fff;
            border-radius: var(--radius);
            font-weight: 700;
            padding: 10px 16px;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(214, 73, 51, 0.6);
            transition: background-color 0.3s ease;
            user-select: none;
        }

        form.logout-form button.btn-logout:hover {
            background-color: #c13925;
            box-shadow: 0 6px 14px rgba(193, 57, 37, 0.85);
        }

        /* Badge dernier sync */
        .badge-sync {
            background-color: var(--accent-gold);
            color: #072214;
            padding: 6px 14px;
            font-weight: 700;
            border-radius: 999px;
            font-size: 13px;
            user-select: none;
        }

        /* === KPI Cards === */
        .kpi-row {
            margin-top: 20px;
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .kpi-card {
            flex: 1 1 210px;
            min-width: 210px;
            background: var(--panel-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow-glass);
            padding: 20px 24px;
            border: 1px solid var(--border-color);
            user-select: none;
            transition: transform 0.3s ease;
        }

        .kpi-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 14px 48px rgba(40, 199, 111, 0.35);
        }

        .kpi-label {
            font-size: 14px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1.1px;
            font-weight: 600;
        }

        .kpi-value {
            margin-top: 8px;
            font-size: 32px;
            font-weight: 700;
            color: var(--accent-green);
            letter-spacing: 0.02em;
        }

        .kpi-subtext {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 4px;
            font-weight: 500;
            user-select: text;
        }

        /* === Grid principale === */
        .dashboard-grid {
            display: grid;
            grid-template-columns: 3fr 1.6fr;
            gap: 24px;
            margin-top: 30px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .dashboard-grid {
                grid-template-columns: 1fr;
            }

            .kpi-row {
                justify-content: center;
            }
        }

        /* === Cards === */
        .card {
            background: var(--panel-bg);
            border-radius: var(--radius);
            box-shadow: var(--shadow-glass);
            padding: 20px;
            border: 1px solid var(--border-color);
        }

        .card h3 {
            margin-top: 0;
            font-weight: 700;
            font-size: 22px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 10px;
            user-select: none;
        }

        /* === Graphiques === */
        .charts {
            display: flex;
            gap: 16px;
            flex-wrap: nowrap;
            overflow-x: auto;
            padding-bottom: 12px;
            margin-top: 14px;
        }

        .chart-canvas {
            flex: 1 1 280px;
            min-width: 280px;
            height: 280px !important;
            user-select: none;
        }

        /* === Tables === */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 14px;
            user-select: text;
        }

        thead th {
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            padding-bottom: 8px;
            border-bottom: 2px solid var(--border-color);
            color: var(--accent-gold);
        }

        tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid rgba(255 255 255 / 0.1);
            vertical-align: middle;
            font-size: 13.5px;
            color: var(--text-light);
        }

        tbody tr:hover {
            background-color: rgba(40, 199, 111, 0.08);
        }

        tbody td.name-cell {
            display: flex;
            align-items: center;
            gap: 12px;
            font-weight: 600;
        }

        tbody img.avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            user-select: none;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        }

        /* === Activity Feed === */
        .activity-feed {
            max-height: 360px;
            overflow-y: auto;
            user-select: none;
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.5;
        }

        .activity-feed .item {
            padding: 12px 10px;
            border-bottom: 1px solid rgba(255 255 255 / 0.05);
            transition: background-color 0.2s ease;
        }

        .activity-feed .item:hover {
            background-color: rgba(40, 199, 111, 0.15);
            color: var(--text-light);
        }

        /* === Bulletin officiel === */
        textarea#bulletin-area {
            width: 100%;
            min-height: 110px;
            padding: 14px 16px;
            font-size: 15px;
            border-radius: var(--radius);
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-light);
            resize: vertical;
            user-select: text;
            font-family: var(--font-family);
            transition: border-color 0.3s ease;
        }

        textarea#bulletin-area:focus {
            border-color: var(--accent-green);
            outline: none;
            box-shadow: 0 0 12px var(--accent-green);
        }

        .btn-row {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 12px;
        }

        /* === Mini alert === */
        .mini-alert {
            position: fixed;
            right: 18px;
            top: 18px;
            background: rgba(4, 20, 10, 0.75);
            padding: 12px 18px;
            border-radius: var(--radius);
            border: 1px solid rgba(40, 199, 111, 0.8);
            display: none;
            align-items: center;
            gap: 14px;
            box-shadow: 0 10px 32px rgba(40, 199, 111, 0.8);
            z-index: 9999;
            color: var(--text-light);
            font-weight: 600;
            user-select: none;
            max-width: 320px;
        }

        /* === Modal === */
        .modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(2, 6, 4, 0.85);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 20000;
        }

        .modal {
            background: var(--panel-bg);
            padding: 24px 28px;
            border-radius: var(--radius);
            border: 1px solid var(--border-color);
            width: 380px;
            max-width: 95vw;
            user-select: none;
            box-shadow: 0 0 28px rgba(40, 199, 111, 0.7);
            color: var(--text-light);
        }

        .modal h3 {
            margin-top: 0;
            font-weight: 700;
            font-size: 22px;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 12px;
        }

        .modal label {
            display: block;
            margin-top: 14px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-muted);
            user-select: text;
        }

        .modal input,
        .modal select,
        .modal textarea {
            width: 100%;
            padding: 10px 14px;
            margin-top: 6px;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background: transparent;
            color: var(--text-light);
            font-size: 15px;
            font-family: var(--font-family);
            user-select: text;
            transition: border-color 0.3s ease;
        }

        .modal input:focus,
        .modal select:focus,
        .modal textarea:focus {
            outline: none;
            border-color: var(--accent-green);
            box-shadow: 0 0 16px var(--accent-green);
        }

        .modal .btn-row {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            gap: 14px;
        }

        .modal .btn {
            padding: 10px 18px;
            font-weight: 600;
        }

        .modal .btn.alt {
            background: transparent;
            border: 1.5px solid var(--text-muted);
            color: var(--text-muted);
        }

        .modal .btn.alt:hover {
            background: var(--glass-bg);
            border-color: var(--accent-green);
            color: var(--accent-green);
        }
        /* Style pour la sélection du rôle PCO */
        #create-pco-form select#pco-type {
            background-color: #2e7d32;   /* vert foncé */
            color: #ffffff;              /* texte blanc */
            border: 1px solid #1b5e20;  /* bordure plus foncée */
            border-radius: 4px;
            padding: 8px 12px;
            font-size: 1rem;
            width: 100%;
            box-sizing: border-box;
            transition: background-color 0.3s ease;
        }

        #create-pco-form select#pco-type:focus {
            background-color: #388e3c;
            outline: none;
            border-color: #81c784;
            color: #e8f5e9;
        }


    </style>
</head>
<body>
    <div class="container">
        <header class="topbar" role="banner" aria-label="Barre supérieure">
            <div class="brand" aria-label="Logo et titre de la plateforme">
                <div class="logo" aria-hidden="true">GE</div>
                <div>
                    <h1>GabonÉcho — Tableau de bord Directeur</h1>
                    <div class="subtitle">Bonjour, {{ $user->first_name ?? 'Directeur' }} — Vue décisionnelle</div>
                </div>
            </div>

            <nav class="actions" role="navigation" aria-label="Actions du tableau de bord">
                <button class="btn" id="btn-publish" onclick="openPublish()" aria-haspopup="dialog" aria-controls="modal-publish">Publier bulletin</button>
                <button class="btn alt" onclick="openCreatePco()" aria-haspopup="dialog" aria-controls="modal-create-pco">Créer PCO</button>
                <a href="{{ route('home') }}" class="btn alt" aria-label="Voir la page d'accueil">Page d'accueil</a>

                <form method="POST" action="{{ route('logout') }}" class="logout-form" role="form" aria-label="Formulaire de déconnexion">
                    @csrf
                    <button type="submit" class="btn-logout" aria-label="Se déconnecter">Déconnexion</button>
                </form>

                <div class="badge-sync" id="last-sync" aria-live="polite" aria-atomic="true">—</div>
            </nav>
        </header>

        <section class="kpi-row" aria-label="Indicateurs clés de performance">
            <article class="kpi-card" tabindex="0">
                <div class="kpi-label">Total utilisateurs</div>
                <div id="kpi-users" class="kpi-value" aria-live="polite" aria-atomic="true">—</div>
                <div class="kpi-subtext">Source : base de données</div>
            </article>
            <article class="kpi-card" tabindex="0">
                <div class="kpi-label">Total articles</div>
                <div id="kpi-articles" class="kpi-value" aria-live="polite" aria-atomic="true">{{ $user->articles()->count() }}</div>
                <div class="kpi-subtext">Depuis le lancement</div>
            </article>
            <article class="kpi-card" tabindex="0">
                <div class="kpi-label">Propositions (30 jours)</div>
                <div id="kpi-proposals" class="kpi-value" aria-live="polite" aria-atomic="true">—</div>
                <div class="kpi-subtext">Tendance</div>
            </article>
            <article class="kpi-card" tabindex="0">
                <div class="kpi-label">Taux de résolution</div>
                <div id="kpi-resolution" class="kpi-value" aria-live="polite" aria-atomic="true">— %</div>
                <div class="kpi-subtext">Signalements résolus</div>
            </article>
        </section>

        <main class="dashboard-grid" role="main">
            <section aria-label="Graphiques et statistiques">
                <div class="card" aria-live="polite" aria-busy="true">
                    <h3>Graphiques dynamiques</h3>
                    <div class="charts" aria-label="Graphiques des propositions, signalements et utilisateurs">
                        <canvas id="chartProposals" class="chart-canvas" role="img" aria-describedby="descChartProposals"></canvas>
                        <canvas id="chartReports" class="chart-canvas" role="img" aria-describedby="descChartReports"></canvas>
                        <canvas id="chartUsers" class="chart-canvas" role="img" aria-describedby="descChartUsers"></canvas>
                    </div>
                </div>

                <!-- === TABLEAU UTILISATEURS RÉCENTS avec actions MODIFIER et SUPPRIMER === -->
                <div class="card" style="margin-top: 26px;">
                    <h3>Utilisateurs récents <small class="kpi-subtext">Derniers utilisateurs actifs</small></h3>
                    <table class="users-table" role="table" aria-label="Tableau des utilisateurs récents">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rôle</th>
                                <th scope="col">Dernière connexion</th>
                                <th scope="col">Actions</th> <!-- Colonne ajoutée -->
                            </tr>
                        </thead>
                        <tbody id="users-tbody">
                            <tr>
                                <td colspan="5" class="kpi-subtext">Chargement...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card" style="margin-top: 26px;">
                    <h3>Gestion PCO <small class="kpi-subtext">Derniers PCOs créés</small></h3>
                    <table class="pcos-table" role="table" aria-label="Tableau des PCOs">
                        <thead>
                            <tr>
                                <th scope="col">Nom</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rôle</th>
                                <th scope="col">Dernière connexion</th>
                            </tr>
                        </thead>
                        <tbody id="pcos-tbody">
                            <tr>
                                <td colspan="4" class="kpi-subtext">Chargement...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="card" style="margin-top: 26px;">
                    <h3>Bulletin officiel</h3>
                    <textarea id="bulletin-area" placeholder="Rédigez un bulletin officiel..." aria-label="Zone de rédaction du bulletin officiel"></textarea>
                    <div class="btn-row">
                        <button class="btn" onclick="publishBulletin()">Publier</button>
                        <button class="btn alt" onclick="saveDraft()">Sauvegarder brouillon</button>
                    </div>
                </div>
            </section>

            <aside aria-label="Activités récentes et état du système">
                <div class="card">
                    <h3>Activité récente</h3>
                    <div class="activity-feed" id="activity-feed" tabindex="0" aria-live="polite" aria-busy="true">Chargement...</div>
                </div>

                <div class="card" style="margin-top: 26px;">
                    <h3>Santé du système</h3>
                    <div id="health-list" class="kpi-subtext" tabindex="0" aria-live="polite" aria-busy="true">Chargement...</div>
                </div>
            </aside>
        </main>
    </div>

    <!-- Mini alert -->
    <div class="mini-alert" id="mini-alert" role="alert" aria-live="assertive" aria-atomic="true" aria-relevant="additions" style="display:none;">
        <strong id="mini-title">Info</strong>
        <span id="mini-text">—</span>
    </div>

    <!-- Modal create PCO -->
    <div class="modal-backdrop" id="modal-backdrop" role="dialog" aria-modal="true" aria-labelledby="modal-title" tabindex="-1">
        <div class="modal" role="document">
            <h3 id="modal-title">Créer un PCO</h3>
            <form id="create-pco-form" onsubmit="return submitCreatePco(event)" novalidate>
                @csrf
                <label for="pco-name">Nom complet</label>
                <input id="pco-name" name="name" required autocomplete="name" />

                <label for="pco-email">Email</label>
                <input id="pco-email" name="email" type="email" required autocomplete="email" />

                <label for="pco-type">Rôle</label>
                <select id="pco-type" name="pco_type" required>
                    <option value="" disabled selected>Choisir un rôle</option>
                    <option value="director">Directeur</option>
                    <option value="admin">Admin</option>
                    <option value="developer">Développeur</option>
                    <option value="security">Sécurité</option>
                </select>

                <div class="btn-row">
                    <button type="button" class="btn alt" onclick="closeCreatePco()">Annuler</button>
                    <button type="submit" class="btn">Créer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal modification utilisateur -->
    <div class="modal-backdrop" id="modal-edit-user" role="dialog" aria-modal="true" aria-labelledby="modal-edit-user-title" tabindex="-1" style="display:none;">
        <div class="modal" role="document">
            <h3 id="modal-edit-user-title">Modifier utilisateur</h3>
            <form id="edit-user-form" onsubmit="return submitEditUser(event)" novalidate>
                <input type="hidden" id="edit-user-id" name="id" />
                <label for="edit-user-name">Nom complet</label>
                <input id="edit-user-name" name="name" required autocomplete="name" />

                <label for="edit-user-email">Email</label>
                <input id="edit-user-email" name="email" type="email" required autocomplete="email" />

                <label for="edit-user-role">Rôle</label>
                <select id="edit-user-role" name="role" required>
                    <option value="" disabled>Choisir un rôle</option>
                    <option value="director">Directeur</option>
                    <option value="admin">Admin</option>
                    <option value="developer">Développeur</option>
                    <option value="security">Sécurité</option>
                    <option value="user">Utilisateur</option>
                </select>

                <div class="btn-row" style="margin-top:1em;">
                    <button type="button" class="btn alt" onclick="closeEditUser()">Annuler</button>
                    <button type="submit" class="btn">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        "use strict";

        // === Utils ===
        function formatDateFr(dateStr) {
            if (!dateStr) return '—';
            const d = new Date(dateStr);
            if (isNaN(d)) return 'Date invalide';
            return d.toLocaleDateString('fr-FR', {
                year: 'numeric',
                month: 'short',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Mini alert gestion
        const miniAlert = document.getElementById('mini-alert');
        const miniTitle = document.getElementById('mini-title');
        const miniText = document.getElementById('mini-text');
        let miniTimeout = null;

        function showMiniAlert(title, message, duration = 3500) {
            miniTitle.textContent = title;
            miniText.textContent = message;
            miniAlert.style.display = 'flex';
            clearTimeout(miniTimeout);
            miniTimeout = setTimeout(() => {
                miniAlert.style.display = 'none';
            }, duration);
        }

        // Modal create PCO
        const modalBackdrop = document.getElementById('modal-backdrop');
        const createPcoForm = document.getElementById('create-pco-form');

        function openCreatePco() {
            modalBackdrop.style.display = 'flex';
            document.getElementById('pco-name').focus();
        }

        function closeCreatePco() {
            modalBackdrop.style.display = 'none';
            createPcoForm.reset();
        }

        modalBackdrop.addEventListener('click', e => {
            if (e.target === modalBackdrop) closeCreatePco();
        });

        // Fonction d'envoi du formulaire création PCO
        async function submitCreatePco(event) {
            event.preventDefault();

            const formData = new FormData(createPcoForm);
            const data = Object.fromEntries(formData.entries());

            // Validation simple des champs côté client
            if (!data.name || !data.email || !data.pco_type) {
                showMiniAlert('Erreur', 'Veuillez remplir tous les champs du formulaire.');
                return false;
            }

            // Validation email simple côté client (regex basique)
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(data.email)) {
                showMiniAlert('Erreur', 'Veuillez saisir une adresse email valide.');
                return false;
            }

            try {
                // Récupération du token CSRF dans la meta (vérification)
                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                if (!csrfTokenMeta) {
                    throw new Error('Token CSRF introuvable dans la page.');
                }
                const csrfToken = csrfTokenMeta.content;

                // Préparation de la requête
                const response = await fetch('/api/director/pcos', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(data)
                });

                // Gestion des erreurs HTTP
                if (!response.ok) {
                    let errMsg = 'Erreur lors de la création du PCO.';
                    let fullErrData = null;
                    try {
                        fullErrData = await response.json();
                        if (fullErrData && fullErrData.message) errMsg = fullErrData.message;
                        else if (fullErrData && fullErrData.errors) {
                            errMsg = Object.values(fullErrData.errors).flat().join(' ');
                        }
                    } catch (_) {
                        // Pas JSON retourné, garder le message générique
                    }
                    console.error('Détail erreur création PCO:', fullErrData);
                    throw new Error(errMsg);
                }

                const json = await response.json();

                // Succès
                showMiniAlert('Succès', `PCO créé : ${json.name}`);
                closeCreatePco();
                loadDashboard();

            } catch (err) {
                // Gestion plus claire des erreurs
                if (err.message.toLowerCase().includes('token')) {
                    showMiniAlert('Erreur', 'Session expirée ou problème de sécurité. Veuillez actualiser la page et réessayer.');
                } else {
                    showMiniAlert('Erreur', err.message);
                }
                console.error('submitCreatePco error:', err);
            }
            return false;
        }

        // === Charts ===
        const ctxProposals = document.getElementById('chartProposals').getContext('2d');
        const ctxReports = document.getElementById('chartReports').getContext('2d');
        const ctxUsers = document.getElementById('chartUsers').getContext('2d');
        let chartProposals, chartReports, chartUsers;

        function createChart(ctx, label, labels, data, color) {
            return new Chart(ctx, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label,
                        data,
                        fill: true,
                        backgroundColor: color.replace('1)', '0.15)'),
                        borderColor: color,
                        borderWidth: 2,
                        tension: 0.3,
                        pointRadius: 4,
                        pointHoverRadius: 7,
                        pointBackgroundColor: color
                    }]
                },
                options: {
                    responsive: true,
                    animation: {
                        duration: 800
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                color: '#b5d9b4',
                                font: {
                                    size: 13
                                }
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.05)'
                            }
                        },
                        x: {
                            ticks: {
                                color: '#a9c9a3',
                                font: {
                                    size: 12
                                }
                            },
                            grid: {
                                display: false
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: '#b5d9b4',
                                font: {
                                    size: 14,
                                    weight: '600'
                                }
                            }
                        },
                        tooltip: {
                            mode: 'index',
                            intersect: false,
                            backgroundColor: 'rgba(40, 199, 111, 0.85)',
                            titleFont: {
                                weight: '700'
                            },
                            bodyFont: {
                                size: 14
                            }
                        }
                    },
                    interaction: {
                        mode: 'nearest',
                        intersect: false
                    }
                }
            });
        }

        // === Data fetching & update ===
        const dashboardData = @json($data);
        console.log('Dashboard data:', dashboardData);

        function updateKpis(kpis) {
            if (!kpis) return;
            document.getElementById('kpi-users').textContent = Number(kpis.usersCount ?? 0).toLocaleString('fr-FR');
            document.getElementById('kpi-proposals').textContent = Number(kpis.proposals30d ?? 0).toLocaleString('fr-FR');
            document.getElementById('kpi-resolution').textContent = (Number(kpis.resolutionRate) ?? 0) + ' %';
        }

        function updateLastSync(datetime) {
            document.getElementById('last-sync').textContent = datetime ? 'Dernière synchro : ' + datetime : 'Dernière synchro : —';
        }

        // Escape HTML simple pour éviter les injections dans le HTML
        function escapeHtml(text) {
            if (!text) return '';
            return text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }

        // On modifie la fonction populateTable pour les users pour ajouter actions
        function populateTable(tbodyId, items) {
            const tbody = document.getElementById(tbodyId);
            tbody.innerHTML = '';
            if (!items || items.length === 0) {
                const colspan = tbodyId === 'users-tbody' ? 5 : 4;
                tbody.innerHTML = `<tr><td colspan="${colspan}" class="kpi-subtext">Aucun résultat trouvé.</td></tr>`;
                return;
            }
            for (const item of items) {
                if (tbodyId === 'users-tbody') {
                    // Ajout des boutons Modifier et Supprimer
                    tbody.insertAdjacentHTML('beforeend', `
                        <tr data-user-id="${item.id}">
                            <td>${escapeHtml(item.name ?? '—')}</td>
                            <td><a href="mailto:${escapeHtml(item.email ?? '#')}" style="color: var(--accent-green)">${escapeHtml(item.email ?? '—')}</a></td>
                            <td>${escapeHtml(item.role ?? '—')}</td>
                            <td>${formatDateFr(item.last_login)}</td>
                            <td>
                                <button class="btn alt btn-edit-user" aria-label="Modifier ${escapeHtml(item.name ?? 'utilisateur')}">Modifier</button>
                                <button class="btn btn-delete-user" aria-label="Supprimer ${escapeHtml(item.name ?? 'utilisateur')}">Supprimer</button>
                            </td>
                        </tr>
                    `);
                } else {
                    // PCO table
                    tbody.insertAdjacentHTML('beforeend', `
                        <tr>
                            <td>${escapeHtml(item.name ?? '—')}</td>
                            <td><a href="mailto:${escapeHtml(item.email ?? '#')}" style="color: var(--accent-green)">${escapeHtml(item.email ?? '—')}</a></td>
                            <td>${escapeHtml(item.role ?? '—')}</td>
                            <td>${formatDateFr(item.last_login)}</td>
                        </tr>
                    `);
                }
            }

            if (tbodyId === 'users-tbody') {
                // Ajouter les listeners sur les boutons Modifier et Supprimer
                tbody.querySelectorAll('.btn-edit-user').forEach(button => {
                    button.addEventListener('click', event => {
                        const tr = event.target.closest('tr');
                        const userId = tr.getAttribute('data-user-id');
                        openEditUser(userId);
                    });
                });
                tbody.querySelectorAll('.btn-delete-user').forEach(button => {
                    button.addEventListener('click', event => {
                        const tr = event.target.closest('tr');
                        const userId = tr.getAttribute('data-user-id');
                        deleteUser(userId);
                    });
                });
            }
        }

        function populateActivityFeed(items) {
            const feed = document.getElementById('activity-feed');
            feed.innerHTML = '';
            if (!items || items.length === 0) {
                feed.textContent = 'Aucune activité récente.';
                return;
            }
            for (const activity of items) {
                const div = document.createElement('div');
                div.className = 'item';
                div.textContent = activity;
                feed.appendChild(div);
            }
        }

        function populateHealthList(items) {
            const container = document.getElementById('health-list');
            container.innerHTML = '';
            if (!items || items.length === 0) {
                container.textContent = 'Aucun état disponible.';
                return;
            }
            const ul = document.createElement('ul');
            ul.style.paddingLeft = '20px';
            ul.style.margin = 0;
            for (const state of items) {
                const li = document.createElement('li');
                li.textContent = state;
                ul.appendChild(li);
            }
            container.appendChild(ul);
        }

        // ========== MODAL ÉDITION UTILISATEUR ===========
        const modalEditUser = document.getElementById('modal-edit-user');
        const editUserForm = document.getElementById('edit-user-form');

        // Ouvre le modal avec les données de l'utilisateur sélectionné
        function openEditUser(userId) {
            // Recherche des données utilisateur dans dashboardData.usersList
            const user = dashboardData.usersList.find(u => u.id == userId);
            if (!user) {
                showMiniAlert('Erreur', 'Utilisateur introuvable.');
                return;
            }
            document.getElementById('edit-user-id').value = user.id;
            document.getElementById('edit-user-name').value = user.name ?? '';
            document.getElementById('edit-user-email').value = user.email ?? '';
            document.getElementById('edit-user-role').value = user.role ?? '';

            modalEditUser.style.display = 'flex';
            document.getElementById('edit-user-name').focus();
        }

        function closeEditUser() {
            modalEditUser.style.display = 'none';
            editUserForm.reset();
        }

        modalEditUser.addEventListener('click', e => {
            if (e.target === modalEditUser) closeEditUser();
        });

        // Soumission du formulaire modification utilisateur
        async function submitEditUser(event) {
            event.preventDefault();

            const formData = new FormData(editUserForm);
            const data = Object.fromEntries(formData.entries());

            if (!data.name || !data.email || !data.role) {
                showMiniAlert('Erreur', 'Veuillez remplir tous les champs du formulaire.');
                return false;
            }

            // Validation email basique
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(data.email)) {
                showMiniAlert('Erreur', 'Veuillez saisir une adresse email valide.');
                return false;
            }

            try {
                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                if (!csrfTokenMeta) throw new Error('Token CSRF introuvable.');

                const csrfToken = csrfTokenMeta.content;

                // Requête PUT (ou PATCH) pour modifier utilisateur
                const response = await fetch(`/api/users/${data.id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        name: data.name,
                        email: data.email,
                        role: data.role
                    })
                });

                if (!response.ok) {
                    let errMsg = 'Erreur lors de la modification.';
                    try {
                        const errData = await response.json();
                        if (errData && errData.message) errMsg = errData.message;
                    } catch (_) {}
                    throw new Error(errMsg);
                }

                showMiniAlert('Succès', `Utilisateur modifié : ${data.name}`);
                closeEditUser();
                loadDashboard();

            } catch (err) {
                if (err.message.toLowerCase().includes('token')) {
                    showMiniAlert('Erreur', 'Session expirée ou problème de sécurité. Veuillez actualiser la page et réessayer.');
                } else {
                    showMiniAlert('Erreur', err.message);
                }
                console.error('submitEditUser error:', err);
            }
            return false;
        }

        // Suppression utilisateur avec confirmation
        async function deleteUser(userId) {
            if (!confirm('Voulez-vous vraiment supprimer cet utilisateur ? Cette action est irréversible.')) {
                return;
            }

            try {
                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                if (!csrfTokenMeta) throw new Error('Token CSRF introuvable.');

                const csrfToken = csrfTokenMeta.content;

                const response = await fetch(`/api/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                if (!response.ok) {
                    let errMsg = 'Erreur lors de la suppression.';
                    try {
                        const errData = await response.json();
                        if (errData && errData.message) errMsg = errData.message;
                    } catch (_) {}
                    throw new Error(errMsg);
                }

                showMiniAlert('Succès', 'Utilisateur supprimé.');
                loadDashboard();

            } catch (err) {
                if (err.message.toLowerCase().includes('token')) {
                    showMiniAlert('Erreur', 'Session expirée ou problème de sécurité. Veuillez actualiser la page et réessayer.');
                } else {
                    showMiniAlert('Erreur', err.message);
                }
                console.error('deleteUser error:', err);
            }
        }

        function loadDashboard() {
            try {
                updateKpis(dashboardData.kpis);
                updateLastSync(dashboardData.lastSync);
                populateTable('users-tbody', dashboardData.usersList);
                populateTable('pcos-tbody', dashboardData.pcosList);
                populateActivityFeed(dashboardData.activity);
                populateHealthList(dashboardData.health);

                if (chartProposals) chartProposals.destroy();
                if (chartReports) chartReports.destroy();
                if (chartUsers) chartUsers.destroy();

                chartProposals = createChart(
                    ctxProposals,
                    'Propositions',
                    dashboardData.proposals?.labels ?? [],
                    dashboardData.proposals?.data ?? [],
                    'rgba(40, 199, 111, 1)'
                );
                chartReports = createChart(
                    ctxReports,
                    'Signalements',
                    dashboardData.reports?.labels ?? [],
                    dashboardData.reports?.data ?? [],
                    'rgba(255, 123, 0, 1)'
                );
                chartUsers = createChart(
                    ctxUsers,
                    'Utilisateurs',
                    dashboardData.users?.labels ?? [],
                    dashboardData.users?.data ?? [],
                    'rgba(60, 180, 215, 1)'
                );
            } catch (error) {
                showMiniAlert('Erreur', 'Impossible de charger les données du tableau de bord.');
                console.error('loadDashboard error:', error);
            }
        }

        // === Bulletin officiel ===
        async function publishBulletin() {
            const content = document.getElementById('bulletin-area').value.trim();
            if (content.length < 10) {
                showMiniAlert('Erreur', 'Le bulletin doit contenir au moins 10 caractères.');
                return;
            }
            try {
                const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
                if (!csrfTokenMeta) {
                    throw new Error('Token CSRF introuvable dans la page.');
                }
                const csrfToken = csrfTokenMeta.content;

                const response = await fetch('/api/bulletin/publish', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ content })
                });

                if (!response.ok) {
                    let errMsg = 'Erreur lors de la publication.';
                    try {
                        const errData = await response.json();
                        if (errData && errData.message) errMsg = errData.message;
                    } catch (_) {}
                    throw new Error(errMsg);
                }

                showMiniAlert('Succès', 'Bulletin publié.');
                document.getElementById('bulletin-area').value = '';
                localStorage.removeItem('bulletinDraft');

            } catch (err) {
                if (err.message.toLowerCase().includes('token')) {
                    showMiniAlert('Erreur', 'Session expirée ou problème de sécurité. Veuillez actualiser la page et réessayer.');
                } else {
                    showMiniAlert('Erreur', err.message);
                }
                console.error('publishBulletin error:', err);
            }
        }

        function saveDraft() {
            const content = document.getElementById('bulletin-area').value.trim();
            localStorage.setItem('bulletinDraft', content);
            showMiniAlert('Info', 'Brouillon sauvegardé localement.');
        }

        function openPublish() {
            alert("Fonctionnalité de publication à implémenter.");
        }

        document.addEventListener('DOMContentLoaded', () => {
            const draft = localStorage.getItem('bulletinDraft');
            if (draft) {
                document.getElementById('bulletin-area').value = draft;
            }

            // Ajout de l'écouteur submit sur le formulaire création PCO
            createPcoForm.addEventListener('submit', submitCreatePco);
            editUserForm.addEventListener('submit', submitEditUser);

            loadDashboard();
        });

    </script>
</body>
</html>
