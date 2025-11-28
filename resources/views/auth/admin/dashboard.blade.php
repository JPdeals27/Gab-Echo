<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Modération — Admin</title>
    <style>
        :root {
            --primary: #1f6feb;
            --accent: #06b6d4;
            --bg: #f7fafc;
            --card: #ffffff;
            --muted: #6b7280
        }

        body {
            font-family: Inter, Arial, sans-serif;
            background: var(--bg);
            color: #0f172a;
            margin: 0
        }

        .wrap {
            max-width: 1200px;
            margin: 0 auto;
            padding: 18px
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        .h1 {
            margin: 0
        }

        .grid {
            display: grid;
            grid-template-columns: 2fr 360px;
            gap: 16px;
            margin-top: 12px
        }

        .card {
            background: var(--card);
            border-radius: 8px;
            padding: 12px;
            box-shadow: 0 4px 12px rgba(2, 6, 23, 0.06)
        }

        .filters {
            display: flex;
            gap: 8px;
            flex-wrap: wrap
        }

        .filters select,
        input {
            padding: 8px;
            border: 1px solid #e6eef6;
            border-radius: 6px
        }

        .table-wrap {
            overflow: auto;
            margin-top: 12px
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px
        }

        th,
        td {
            padding: 10px;
            border-bottom: 1px solid #eef2f7;
            text-align: left
        }

        .badge {
            padding: 4px 8px;
            border-radius: 999px;
            font-size: 12px
        }

        .badge-high {
            background: #fee2e2;
            color: #b91c1c
        }

        .badge-med {
            background: #fff7ed;
            color: #92400e
        }

        .badge-low {
            background: #ecfeff;
            color: #064e3b
        }

        .actions {
            display: flex;
            gap: 6px
        }

        .btn {
            padding: 6px 10px;
            border-radius: 6px;
            border: none;
            background: var(--primary);
            color: #fff;
            cursor: pointer
        }

        .btn-ghost {
            background: transparent;
            border: 1px solid #e6eef6;
            color: var(--primary)
        }

        .small {
            font-size: 13px;
            color: var(--muted)
        }

        .sidebar .list {
            list-style: none;
            padding: 0;
            margin: 0
        }

        .sidebar .item {
            padding: 10px;
            border-bottom: 1px dashed #eef2f7
        }

        .stat-row {
            display: flex;
            gap: 8px;
            margin-top: 10px
        }

        .stat {
            flex: 1;
            background: linear-gradient(180deg, #fff, #fbfdff);
            padding: 10px;
            border-radius: 8px;
            text-align: center
        }

        .btn-logout {
            background-color: #d9534f; /* rouge bootstrap danger */
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 10px;
            font-weight: 700;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background-color 0.3s ease;
        }

        .search {
            display: flex;
            gap: 8px
        }

        input[type=search] {
            flex: 1;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #e6eef6
        }

        .note {
            font-size: 13px;
            color: var(--muted);
            margin-top: 8px
        }

        .drag-hint {
            font-size: 12px;
            color: var(--muted)
        }

    </style>
</head>
<body>
    <div class="wrap">
        <div class="header">
            <div>
                <h1 class="h1">Modération opérationnelle</h1>
                <div class="small">Queue centralisée · actions rapides · filtrage</div>
            </div>
            <div class="search">
                <input type="search" id="global-search" placeholder="Rechercher par titre / email / id" />
                <button class="btn btn-ghost" onclick="lookup()">Chercher</button>
            </div>
        </div>

        <div class="grid" style="margin-top:14px">
            <main>
                <div class="card">
                    <h3>Queue de modération</h3>
                    <div class="filters" style="margin-top:8px">
                        <select id="filter-region">
                            <option value="">Toutes régions</option>
                            <option>Est</option>
                            <option>Ouest</option>
                            <option>Nord</option>
                            <option>Sud</option>
                        </select>
                        <select id="filter-category">
                            <option value="">Toutes catégories</option>
                            <option>Éducation</option>
                            <option>Santé</option>
                            <option>Transport</option>
                        </select>
                        <input type="number" id="filter-tox" placeholder="Toxicité ≥" min="0" max="100" />
                        <input type="date" id="filter-from" />
                        <input type="date" id="filter-to" />
                        <button class="btn" onclick="applyFilters()">Filtrer</button>
                        <button class="btn btn-ghost" onclick="resetFilters()">Réinitialiser</button>
                    </div>

                    <div class="table-wrap" id="queue-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th>Auteur</th>
                                    <th>Extrait</th>
                                    <th>Score</th>
                                    <th>#Signalements</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="queue-tbody">
                                <tr>
                                    <td colspan="6" class="small">Chargement de la queue...</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="note">Source: /api/moderation/queue?limit=50 — Drag & drop pour réassigner (simulé)</div>
                </div>

                <div class="card" style="margin-top:12px">
                    <h3>Statistiques modération</h3>
                    <div class="stat-row">
                        <div class="stat">
                            <div class="small">Temps moyen traitement</div>
                            <div id="stat-avg">—</div>
                        </div>
                        <div class="stat">
                            <div class="small">Taux false-positive</div>
                            <div id="stat-fp">—</div>
                        </div>
                        <div class="stat">
                            <div class="small">Utilisateurs bannis</div>
                            <div id="stat-banned">—</div>
                        </div>
                    </div>
                    <div style="margin-top:10px" class="small">Source: /api/moderation/stats</div>
                </div>

                <div class="card" style="margin-top:12px">
                    <h3>Journal d'actions de modération</h3>
                    <div id="moderation-logs" style="max-height:260px;overflow:auto">
                        <div class="small">Chargement des logs...</div>
                    </div>
                </div>
            </main>

            <aside class="sidebar">
                <div class="card">
                    <h3>Signalements récents</h3>
                    <ul class="list" id="reports-list">
                        <li class="item small">Chargement...</li>
                    </ul>
                    <div style="margin-top:8px;display:flex;gap:8px">
                        <button class="btn" onclick="assignReport()">Assigner</button>
                        <button class="btn btn-ghost" onclick="escalate()">Escalader</button>
                    </div>
                </div>

                <div class="card" style="margin-top:12px">
                    <h3>Quick actions</h3>
                    <div style="display:flex;flex-direction:column;gap:8px">
                        <button class="btn" onclick="bulkValidate()">Valider la sélection</button>
                        <button class="btn btn-ghost" onclick="bulkSuspend()">Suspendre auteur</button>
                        <button class="btn" onclick="warnAuthor()">Envoyer avertissement</button>
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

                <div class="card" style="margin-top:12px">
                    <h3>Recherche utilisateur</h3>
                    <input type="text" id="user-lookup" placeholder="email ou téléphone" />
                    <div style="margin-top:8px"><button class="btn" onclick="lookupUser()">Lookup</button></div>
                    <div id="user-lookup-result" class="small" style="margin-top:8px"></div>
                </div>
            </aside>
        </div>
    </div>

    <script>
        async function loadQueue() {
            try {
                const res = await fetch('/api/moderation/queue?limit=50');
                const data = await res.json();
                const tbody = document.getElementById('queue-tbody');
                tbody.innerHTML = '';
                if (!data || !data.length) {
                    tbody.innerHTML = '<tr><td colspan="6" class="small">Aucune proposition en attente.</td></tr>';
                    return
                }
                data.forEach(p => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `<td><a href="/proposals/${p.id}">${escapeHtml(p.title)}</a></td><td>${escapeHtml(p.author_name||'Anonyme')}</td><td>${escapeHtml((p.excerpt||'').slice(0,120))}</td><td><span class="badge ${p.score>80?'badge-high':p.score>50?'badge-med':'badge-low'}">${p.score}</span></td><td>${p.reports_count||0}</td><td class="actions"><button class="btn" onclick="approve(${p.id})">Valider</button><button class="btn btn-ghost" onclick="suspend(${p.user_id})">Suspendre</button><button class="btn" onclick="warn(${p.user_id})">Avertir</button></td>`;
                    tbody.appendChild(tr);
                });
            } catch (e) {
                console.error(e);
            }
        }

        async function loadReports() {
            try {
                const res = await fetch('/api/moderation/reports?limit=10');
                const list = await res.json();
                const ul = document.getElementById('reports-list');
                ul.innerHTML = '';
                if (!list || !list.length) {
                    ul.innerHTML = '<li class="item small">Aucun signalement</li>';
                    return
                }
                list.forEach(r => {
                    const li = document.createElement('li');
                    li.className = 'item';
                    li.innerHTML = `<div><strong>${escapeHtml(r.reason)}</strong><div class="small">${escapeHtml(r.target)} · ${new Date(r.created_at).toLocaleString()}</div></div><div><span class="small">${r.priority||'low'}</span></div>`;
                    ul.appendChild(li);
                });
            } catch (e) {
                console.error(e)
            }
        }

        async function loadStats() {
            try {
                const s = await fetch('/api/moderation/stats').then(r => r.json());
                document.getElementById('stat-avg').textContent = s.avg_time || '—';
                document.getElementById('stat-fp').textContent = (s.false_positive_rate || '—') + '%';
                document.getElementById('stat-banned').textContent = s.banned_users || 0;
            } catch (e) {
                console.error(e)
            }
        }

        async function loadLogs() {
            try {
                const logs = await fetch('/api/audit/moderation?limit=50').then(r => r.json());
                const container = document.getElementById('moderation-logs');
                container.innerHTML = '';
                if (!logs || !logs.length) {
                    container.innerHTML = '<div class="small">Aucun log</div>';
                    return
                }
                logs.forEach(l => {
                    const d = document.createElement('div');
                    d.className = 'small';
                    d.textContent = `${l.created_at} · ${l.actor || 'système'} · ${l.action}`;
                    container.appendChild(d);
                });
            } catch (e) {
                console.error(e)
            }
        }

        function escapeHtml(s) {
            if (!s) return '';
            return s.replace(/[&<>"']/g, (c) => ({
                '&': '&amp;'
                , '<': '&lt;'
                , '>': '&gt;'
                , '"': '&quot;'
                , '\'":"&#39;'
            } [c]));
        }

        // actions
        async function approve(id) {
            if (!confirm('Valider cette proposition ?')) return;
            await fetch(`/api/moderation/approve/${id}`, {
                method: 'PATCH'
            });
            loadQueue();
        }
        async function suspend(userId) {
            const reason = prompt('Raison de la suspension (court)');
            if (!reason) return;
            await fetch(`/api/users/suspend/${userId}`, {
                method: 'PATCH'
                , headers: {
                    'Content-Type': 'application/json'
                }
                , body: JSON.stringify({
                    reason
                })
            });
            loadQueue();
        }
        async function warn(userId) {
            const msg = prompt('Message d avertissement');
            if (!msg) return;
            await fetch(`/api/users/warn/${userId}`, {
                method: 'POST'
                , headers: {
                    'Content-Type': 'application/json'
                }
                , body: JSON.stringify({
                    message: msg
                })
            });
            alert('Avertissement envoyé');
        }

        // quick actions
        function bulkValidate() {
            alert('Action bulk validate (simulé)');
        }

        function bulkSuspend() {
            alert('Action bulk suspend (simulé)');
        }

        function assignReport() {
            alert('Assigner signalement (simulé)');
        }

        function escalate() {
            alert('Escalation envoyée');
        }

        function warnAuthor() {
            alert('Avertissement envoyé');
        }

        function lookup() {
            const q = document.getElementById('global-search').value;
            if (!q) return alert('Entrez un terme');
            window.location.href = '/admin/users?search=' + encodeURIComponent(q);
        }

        function lookupUser() {
            const q = document.getElementById('user-lookup').value;
            if (!q) return alert('Entrez email/tel');
            fetch('/api/users/lookup?term=' + encodeURIComponent(q)).then(r => r.json()).then(j => {
                document.getElementById('user-lookup-result').textContent = j.email ? (j.name + ' · ' + j.email) : 'Utilisateur non trouvé';
            }).catch(e => console.error(e));
        }

        function applyFilters() {
            loadQueue();
        }

        function resetFilters() {
            document.getElementById('filter-region').value = '';
            document.getElementById('filter-category').value = '';
            document.getElementById('filter-tox').value = '';
            document.getElementById('filter-from').value = '';
            document.getElementById('filter-to').value = '';
            loadQueue();
        }

        // init
        (function init() {
            loadQueue();
            loadReports();
            loadStats();
            loadLogs();
        })();

    </script>
</body>
</html>
