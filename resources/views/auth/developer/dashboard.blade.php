{{-- resources/views/dashboards/dev.blade.php --}}
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>GabonÉcho — Tableau Dev</title>

    {{-- Laravel CSRF meta pour fetch --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&family=Source+Code+Pro:wght@400;600&display=swap" rel="stylesheet">

    <style>
        :root{
            --bg-1: linear-gradient(180deg, #071227 0%, #02060a 100%);
            --card: linear-gradient(180deg,#0b1226 0%, #041022 100%);
            --accent: #7c3aed;
            --accent-2: #22c1c3;
            --muted: #9fb4c8;
            --glass: rgba(255,255,255,0.03);
            --radius: 12px;
            --mono: 'Source Code Pro', monospace;
        }
        *{box-sizing:border-box}
        html,body{height:100%;margin:0;font-family:Inter,Arial,sans-serif;background:var(--bg-1);color:#e6eef8}
        a{color:var(--accent)}
        .container{max-width:1280px;margin:24px auto;padding:16px}
        .topbar{display:flex;justify-content:space-between;align-items:center;gap:12px}
        .brand{display:flex;gap:12px;align-items:center}
        .logo{
            width:48px;height:48px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent-2));
            display:flex;align-items:center;justify-content:center;font-weight:800;color:#031021;font-size:18px;box-shadow:0 8px 30px rgba(0,0,0,0.45)
        }
        h1{margin:0;font-size:1.4rem}
        .subtitle{color:var(--muted);font-size:0.95rem}
        .actions{display:flex;gap:10px;align-items:center}
        .btn{
            background:var(--accent);color:#041022;border:none;padding:10px 14px;border-radius:10px;font-weight:700;cursor:pointer;box-shadow:0 6px 20px rgba(0,0,0,0.45)
        }
        .btn.ghost{background:transparent;border:1px solid rgba(255,255,255,0.06);color:var(--muted);font-weight:600}
        .btn.danger{background:#ff5b5b;color:white}
        .layout{display:grid;grid-template-columns:2fr 1fr;gap:16px;margin-top:18px}
        @media(max-width:1000px){.layout{grid-template-columns:1fr}}
        .card{background:var(--card);border-radius:var(--radius);padding:14px;border:1px solid var(--glass);box-shadow:0 8px 30px rgba(0,0,0,0.6)}
        .two-col{display:grid;grid-template-columns:1fr 1fr;gap:8px}
        .muted{color:var(--muted);font-size:0.9rem}
        .small{font-size:0.88rem;color:var(--muted)}
        /* Editor */
        .file-list{max-height:420px;overflow:auto;padding:8px;border-radius:8px;background:#051224;border:1px solid rgba(255,255,255,0.02)}
        .file-item{padding:8px;border-radius:8px;display:flex;justify-content:space-between;align-items:center;gap:8px;cursor:pointer}
        .file-item:hover{background:rgba(255,255,255,0.02)}
        .file-item.active{background:linear-gradient(90deg,rgba(124,58,237,0.12),rgba(34,193,195,0.06));border:1px solid rgba(124,58,237,0.18)}
        .editor { margin-top:12px; display:flex; flex-direction:column; gap:8px}
        textarea.code { width:100%; min-height:340px; resize:vertical; padding:12px; border-radius:10px; border:1px solid rgba(255,255,255,0.04); background:#00101a; color:#dff7ff; font-family:var(--mono); font-size:13px; line-height:1.45 }
        .editor-toolbar{display:flex;gap:8px;align-items:center}
        /* Logs */
        pre.log { background:#021021;padding:12px;border-radius:10px;height:340px;overflow:auto;font-family:var(--mono);font-size:13px;border:1px solid rgba(255,255,255,0.03)}
        table{width:100%;border-collapse:collapse}
        th,td{padding:8px;text-align:left;border-bottom:1px dashed rgba(255,255,255,0.02)}
        .status {padding:6px 8px;border-radius:999px;font-weight:700;font-size:12px}
        .status.green{background:#0f5132;color:#d1ffe6}
        .status.yellow{background:#7a5a00;color:#fff8d6}
        .status.red{background:#611515;color:#ffdede}
        /* modal simple */
        .modal-back{position:fixed;inset:0;background:rgba(0,0,0,0.6);display:none;align-items:center;justify-content:center;z-index:1000}
        .modal{background:var(--card);padding:18px;border-radius:12px;max-width:720px;width:94%;border:1px solid var(--glass)}
        /* toast */
        .toast-container{position:fixed;right:20px;bottom:20px;display:flex;flex-direction:column;gap:8px;z-index:1200}
        .toast{background:rgba(0,0,0,0.6);padding:10px 12px;border-radius:8px;border:1px solid rgba(255,255,255,0.04);color:#eafff0}
        /* small responsive fixes */
        .meta-row{display:flex;gap:12px;align-items:center;flex-wrap:wrap}
    </style>
</head>
<body>
<div class="container">

    {{-- Topbar --}}
    <div class="topbar" role="banner">
        <div class="brand" aria-hidden="false">
            <div class="logo" aria-hidden="true">DEV</div>
            <div>
                <h1>Tableau développeur — Outils techniques</h1>
                <div class="subtitle">Logs, éditeur source, jobs, déploiement — actions protégées</div>
            </div>
        </div>

        <div class="actions" role="navigation">
            <div class="meta-row small">
                <div class="small">Utilisateur: <strong>{{ auth()->user()->prenom ?? auth()->user()->name ?? '—' }}</strong></div>
                <div class="small">Rôle: <strong>{{ auth()->user()->role ?? '—' }}</strong></div>
            </div>

            {{-- Retour accueil --}}
            <a href="{{ url('/') }}" class="btn ghost" style="text-decoration:none;padding:9px 12px;">Accueil</a>

            {{-- Logout form --}}
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:inline;">
                @csrf
                <button type="submit" class="btn ghost" title="Déconnexion">Se déconnecter</button>
            </form>
        </div>
    </div>

    {{-- Access control check (only dev allowed) --}}
    @if(! (auth()->check() && auth()->user()->role === 'developer'))
        <div class="card" style="margin-top:18px">
            <h2>Accès restreint</h2>
            <p class="muted">Vous n'êtes pas autorisé à accéder à ce tableau de bord développeur. Si vous pensez que c'est une erreur, contactez l'administrateur.</p>
            <p class="small">Role requis: <strong>developer</strong></p>
        </div>
        {{-- Stop rendering the rest --}}
    @else

    {{-- Main layout --}}
    <div class="layout" role="main" aria-labelledby="dev-dashboard">

        {{-- LEFT: Editor + Logs + Jobs --}}
        <div>
            {{-- Editor card --}}
            <section class="card" aria-labelledby="editor-title">
                <div style="display:flex;justify-content:space-between;align-items:center;gap:12px">
                    <div>
                        <strong id="editor-title">Éditeur de code — Sources (sandbox)</strong>
                        <div class="muted">Éditez les fichiers source protégés. Actions nécessitent 2FA et une confirmation.</div>
                    </div>

                    <div style="display:flex;gap:8px;align-items:center">
                        <button class="btn ghost" onclick="refreshFiles()">Rafraîchir</button>
                        <button class="btn" id="save-file-btn" onclick="saveFile()">Enregistrer</button>
                        <button class="btn danger" onclick="deployPrompt()">Déployer</button>
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:310px 1fr;gap:12px;margin-top:12px">
                    <div>
                        <div class="small">Fichiers (clic pour ouvrir)</div>
                        <div id="file-list" class="file-list" role="list" aria-label="Liste des fichiers sources">
                            <div class="small" id="file-list-loading">Chargement…</div>
                        </div>
                    </div>

                    <div>
                        <div class="editor">
                            <div class="editor-toolbar">
                                <div class="small">Fichier sélectionné: <strong id="current-file">—</strong></div>
                                <div style="flex:1"></div>
                                <div class="small muted">Dernière sauvegarde: <span id="last-saved">—</span></div>
                            </div>

                            <textarea id="code-editor" class="code" placeholder="// Sélectionner un fichier à gauche pour éditer"></textarea>

                            <div style="display:flex;gap:8px;justify-content:flex-end">
                                <button class="btn ghost" onclick="formatCode()">Format</button>
                                <button class="btn" onclick="saveFile()">Save</button>
                                <button class="btn danger" onclick="guardedAction('rollback')">Rollback</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Logs --}}
            <section class="card" style="margin-top:12px" aria-labelledby="logs-title">
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <div>
                        <strong id="logs-title">Logs (tail)</strong>
                        <div class="muted">Flux en temps réel — filtre: niveau & limite</div>
                    </div>
                    <div style="display:flex;gap:8px;align-items:center">
                        <select id="log-level" onchange="loadLogs()">
                            <option value="all">ALL</option>
                            <option value="error">ERROR</option>
                            <option value="warn">WARN</option>
                            <option value="info">INFO</option>
                            <option value="debug">DEBUG</option>
                        </select>
                        <select id="log-limit" onchange="loadLogs()">
                            <option value="200">200</option>
                            <option value="500">500</option>
                            <option value="1000">1000</option>
                        </select>
                        <button class="btn ghost" id="live-btn" onclick="toggleLive()">Live: ON</button>
                    </div>
                </div>

                <pre id="log-block" class="log">Chargement des logs…</pre>
                <div class="small">Source: <code>/api/dev/logs?level=&limit=</code></div>
            </section>

            {{-- Jobs & Queue --}}
            <section class="card" style="margin-top:12px">
                <div style="display:flex;justify-content:space-between;align-items:center">
                    <div><strong>Jobs & Queue</strong><div class="muted">Runtime, attempts, retry count</div></div>
                    <div><button class="btn ghost" onclick="loadJobs()">Rafraîchir</button></div>
                </div>

                <table aria-label="Jobs list">
                    <thead>
                        <tr><th>Job</th><th>Runtime</th><th>Attempts</th><th>State</th></tr>
                    </thead>
                    <tbody id="jobs-tbody">
                        <tr><td colspan="4" class="small">Chargement...</td></tr>
                    </tbody>
                </table>
            </section>
        </div>

        {{-- RIGHT: Deploy, Health, Actions --}}
        <aside>
            <section class="card">
                <strong>Déploiement & version</strong>
                <div class="muted">Commit / tag / last deploy</div>
                <div id="deploy-meta" style="margin-top:8px" class="small">Chargement…</div>
                <div style="display:flex;gap:8px;margin-top:10px">
                    <button class="btn" onclick="getDeploy()">Rafraîchir</button>
                    <button class="btn ghost" onclick="showRollback()">Rollback (guarded)</button>
                </div>
            </section>

            <section class="card" style="margin-top:12px">
                <strong>Statut stockage / DB</strong>
                <div class="muted">Usage disque, connexions DB, slow queries</div>
                <div id="health-info" style="margin-top:8px" class="small">Chargement…</div>
            </section>

            <section class="card" style="margin-top:12px">
                <strong>Actions protégées (2FA)</strong>
                <div class="muted">Clear cache / Migrate / Rollback — code 2FA requis</div>
                <div style="display:flex;flex-direction:column;gap:8px;margin-top:8px">
                    <button class="btn" onclick="guardedAction('clear-cache')">Clear cache</button>
                    <button class="btn" onclick="guardedAction('migrate')">Run migrations</button>
                    <button class="btn danger" onclick="guardedAction('rollback')">Rollback last deploy</button>
                </div>
            </section>

            <section class="card" style="margin-top:12px">
                <strong>Notifications & Security</strong>
                <div class="muted">Signalements / findings récents</div>
                <div id="sec-notifs" style="margin-top:8px" class="small">Chargement…</div>
            </section>
        </aside>
    </div>

    @endif {{-- end role check --}}

</div>

{{-- Modal container --}}
<div id="modal" class="modal-back" role="dialog" aria-modal="true" aria-hidden="true">
    <div class="modal" id="modal-content"></div>
</div>

<div class="toast-container" id="toast-container" aria-live="polite"></div>

<script>
    // CSRF helper
    const CSRF = document.querySelector('meta[name="csrf-token"]').content;

    // Toast helper
    function toast(msg, duration = 4000) {
        const c = document.getElementById('toast-container');
        const el = document.createElement('div'); el.className = 'toast'; el.textContent = msg;
        c.appendChild(el);
        setTimeout(()=> el.remove(), duration);
    }

    // Modal helpers
    function showModal(html) {
        const modal = document.getElementById('modal');
        const content = document.getElementById('modal-content');
        content.innerHTML = html;
        modal.style.display = 'flex';
        modal.setAttribute('aria-hidden','false');
    }
    function closeModal() {
        const modal = document.getElementById('modal');
        modal.style.display = 'none';
        modal.setAttribute('aria-hidden','true');
    }

    // ====== FILES / EDITOR ======
    let files = []; // {path, name}
    let currentFile = null;
    const fileListEl = document.getElementById('file-list');
    const editorEl = document.getElementById('code-editor');
    const currentFileEl = document.getElementById('current-file');
    const lastSavedEl = document.getElementById('last-saved');

    async function refreshFiles() {
        fileListEl.innerHTML = '<div class="small">Chargement…</div>';
        try {
            const res = await fetch('/api/dev/files',{headers:{'X-CSRF-TOKEN':CSRF}});
            if (!res.ok) throw new Error('Erreur files');
            files = await res.json();
            renderFileList();
        } catch (e) {
            console.error(e);
            fileListEl.innerHTML = '<div class="small">Impossible de charger les fichiers</div>';
        }
    }

    function renderFileList() {
        if (!files || !files.length) {
            fileListEl.innerHTML = '<div class="small">Aucun fichier trouvé</div>'; return;
        }
        fileListEl.innerHTML = '';
        files.forEach(f => {
            const el = document.createElement('div');
            el.className = 'file-item';
            el.setAttribute('role','listitem');
            el.innerHTML = `<div style="flex:1"><strong>${escapeHtml(f.name)}</strong><div class="small">${escapeHtml(f.path)}</div></div><div style="flex-shrink:0"><button class="btn ghost" onclick="openFile('${encodeURIComponent(f.path)}', event)">Ouvrir</button></div>`;
            fileListEl.appendChild(el);
        });
    }

    async function openFile(encodedPath, ev) {
        if (ev) ev.stopPropagation();
        const path = decodeURIComponent(encodedPath);
        try {
            const res = await fetch('/api/dev/files?path='+encodeURIComponent(path), {headers:{'X-CSRF-TOKEN':CSRF}});
            if (!res.ok) throw new Error('read error');
            const data = await res.json();
            currentFile = path;
            currentFileEl.textContent = path;
            editorEl.value = data.content || '';
            lastSavedEl.textContent = data.updated_at || '—';
            // mark selected
            Array.from(document.querySelectorAll('.file-item')).forEach(i=> i.classList.remove('active'));
            ev?.currentTarget?.closest('.file-item')?.classList?.add('active');
        } catch (e) {
            console.error(e);
            toast('Impossible d\'ouvrir le fichier');
        }
    }

    async function saveFile() {
        if (!currentFile) return toast('Pas de fichier sélectionné');
        const code = editorEl.value;
        // confirm and 2FA
        if (!confirm('Enregistrer les modifications dans '+currentFile+' ?')) return;
        const two = prompt('Entrez code 2FA : (nécessaire pour sauvegarde en production)');
        try {
            const res = await fetch('/api/dev/files/save', {
                method:'POST',
                headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
                body: JSON.stringify({path: currentFile, content: code, two_factor: two})
            });
            if (!res.ok) {
                const txt = await res.text();
                throw new Error(txt || 'save failed');
            }
            const json = await res.json();
            lastSavedEl.textContent = json.updated_at || new Date().toISOString();
            toast('Fichier enregistré');
        } catch (e) {
            console.error(e);
            toast('Échec sauvegarde: '+ (e.message || e));
        }
    }

    function formatCode() {
        // Minimal formatting placeholder. You may plug an actual formatter backend.
        const val = editorEl.value;
        // naive: trim trailing spaces
        const formatted = val.split('\n').map(l => l.replace(/\s+$/,'')).join('\n');
        editorEl.value = formatted;
        toast('Format minimal appliqué (trim trailing spaces)');
    }

    // ====== LOGS ======
    let live = true;
    let tailInterval = null;
    function toggleLive() {
        live = !live;
        document.getElementById('live-btn').textContent = 'Live: ' + (live ? 'ON' : 'OFF');
        if (live) startTail();
        else stopTail();
    }
    function startTail() {
        if (tailInterval) clearInterval(tailInterval);
        loadLogs();
        tailInterval = setInterval(()=> {
            if (live) loadLogs(true);
        }, 3000);
    }
    function stopTail(){ if (tailInterval) clearInterval(tailInterval); tailInterval=null; }

    async function loadLogs(append=false) {
        try {
            const level = document.getElementById('log-level').value;
            const limit = document.getElementById('log-limit').value;
            const url = `/api/dev/logs?level=${encodeURIComponent(level)}&limit=${encodeURIComponent(limit)}`;
            const res = await fetch(url);
            if (!res.ok) throw new Error('logs fetch failed');
            const text = await res.text();
            const block = document.getElementById('log-block');
            if (append) block.textContent = block.textContent + '\n' + text;
            else block.textContent = text;
            block.scrollTop = block.scrollHeight;
        } catch (e) {
            console.error(e);
            document.getElementById('log-block').textContent = 'Erreur récupération logs';
        }
    }

    // ====== JOBS ======
    async function loadJobs() {
        try {
            const j = await fetch('/api/dev/jobs').then(r=>r.json());
            const tb = document.getElementById('jobs-tbody');
            tb.innerHTML = '';
            if (!j || !j.length) { tb.innerHTML = '<tr><td colspan="4" class="small">Aucun job</td></tr>'; return; }
            j.forEach(job => {
                const tr = document.createElement('tr');
                tr.innerHTML = `<td>${escapeHtml(job.name)}</td><td>${escapeHtml(job.runtime||'—')}</td><td>${escapeHtml(String(job.attempts||0))}</td><td>${escapeHtml(job.state||'queued')}</td>`;
                tb.appendChild(tr);
            });
        } catch (e) {
            console.error(e);
        }
    }

    // ====== DEPLOY / HEALTH ======
    async function getDeploy() {
        try {
            const d = await fetch('/api/dev/deploy').then(r=>r.json());
            document.getElementById('deploy-meta').innerHTML = `Commit: <strong>${escapeHtml(d.commit||'—')}</strong><br>Tag: ${escapeHtml(d.tag||'—')}<br>Last: ${escapeHtml(d.time||'—')}`;
        } catch (e) {
            console.error(e);
        }
    }
    async function loadHealth() {
        try {
            const h = await fetch('/api/dev/health').then(r=>r.json());
            const el = document.getElementById('health-info');
            el.innerHTML = `<div class="small">Disk free: ${escapeHtml(h.disk_free||'—')} · DB connections: ${escapeHtml(h.db_connections||'—')} · Slow queries: ${escapeHtml(String(h.slow_queries||0))}</div>`;
        } catch (e) { console.error(e) }
    }

    // ====== SECURITY NOTIFS ======
    async function loadSecNotifs() {
        try {
            const s = await fetch('/api/dev/security-notifs').then(r=>r.json());
            document.getElementById('sec-notifs').textContent = s && s.length ? `${s[0].title} · ${s[0].time}` : 'Aucune notification';
        } catch (e) { console.error(e) }
    }

    // ====== Guarded Actions (2FA required) ======
    async function guardedAction(action) {
        if (!confirm(`Exécuter l'action protégée: ${action} ?`)) return;
        const two = prompt('Code 2FA requis :');
        if (!two) return alert('2FA requis');
        try {
            const res = await fetch(`/api/dev/actions/${encodeURIComponent(action)}`, {
                method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
                body: JSON.stringify({two_factor: two})
            });
            if (!res.ok) {
                const txt = await res.text();
                throw new Error(txt || 'action failed');
            }
            const json = await res.json();
            toast('Action exécutée: '+(json.message||action));
            // refresh context
            refreshAll();
        } catch (e) {
            console.error(e); alert('Échec action: '+(e.message||e));
        }
    }

    function deployPrompt() {
        showModal(`<h3>Déployer en production</h3>
            <p class="muted">Confirmer le déploiement. Cette opération est irréversible sans rollback.</p>
            <div style="display:flex;gap:8px;margin-top:12px;justify-content:flex-end">
                <button class="btn ghost" onclick="closeModal()">Annuler</button>
                <button class="btn" onclick="deployNow()">Déployer</button>
            </div>`);
    }

    async function deployNow() {
        closeModal();
        const two = prompt('Code 2FA requis pour déploiement:');
        if (!two) return alert('2FA requis');
        try {
            const res = await fetch('/api/dev/deploy', {
                method:'POST', headers:{'Content-Type':'application/json','X-CSRF-TOKEN':CSRF},
                body: JSON.stringify({two_factor: two})
            });
            if (!res.ok) throw new Error('deploy failed');
            toast('Déploiement lancé');
            refreshAll();
        } catch (e) {
            console.error(e); alert('Échec déploiement');
        }
    }

    function showRollback(){ guardedAction('rollback') }

    // ====== utilities ======
    function escapeHtml(s){if (s===null || s===undefined) return ''; return String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":"&#39;"}[c]));}

    function refreshAll(){
        refreshFiles(); loadLogs(); loadJobs(); getDeploy(); loadHealth(); loadSecNotifs();
    }

    // init
    (function init(){
        refreshAll();
        startTail();
    })();
</script>
</body>
</html>
