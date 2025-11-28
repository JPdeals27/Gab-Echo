<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SOC — Security Officer</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&family=Source+Code+Pro:wght@400;600&display=swap');

        :root {
            --primary: #06121a; /* noir bleuté */
            --accent: #00f5a0; /* néon vert */
            --danger: #ff4d4f;
            --panel: #071821;
            --muted: #8fb3b0;
            --glass: rgba(255, 255, 255, 0.03);
            --radius: 10px;
            --btn-hover-bg: #00d688;
            --btn-danger-hover-bg: #e04347;
            --btn-secondary-bg: #1a2a3a;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            background: linear-gradient(180deg, #03060a, var(--primary));
            color: #dffbf0;
            font-family: Inter, Arial, sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .wrap {
            max-width: 1300px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        h1 {
            margin: 0;
            font-weight: 600;
            font-size: 1.8rem;
        }

        .muted {
            color: var(--muted);
            font-size: 13px;
        }

        .layout {
            display: grid;
            grid-template-columns: 2fr 420px;
            gap: 16px;
            margin-top: 16px;
        }

        .panel {
            background: var(--panel);
            border-radius: var(--radius);
            padding: 12px;
            border: 1px solid var(--glass);
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.6);
        }

        .feed {
            height: 520px;
            overflow-y: auto;
            border-radius: 8px;
            padding: 8px;
            background: linear-gradient(180deg, #06121a, #041316);
            border: 1px solid rgba(0, 245, 160, 0.06);
        }

        .alert-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.03);
            transition: background-color 0.15s ease-in-out;
        }
        .alert-item:hover {
            background-color: rgba(0, 245, 160, 0.1);
        }

        .severity-low {
            color: #9be7c4;
        }

        .severity-med {
            color: #ffe59d;
        }

        .severity-high {
            color: #ffb3a7;
        }

        .severity-critical {
            color: var(--danger);
            font-weight: 700;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            background: var(--accent);
            color: #041014;
            padding: 8px 14px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background-color 0.25s ease-in-out;
            user-select: none;
            box-shadow: 0 2px 6px rgba(0,245,160,0.3);
        }
        .btn:hover {
            background-color: var(--btn-hover-bg);
        }

        .btn-danger {
            background: var(--danger);
            color: #fff;
            box-shadow: 0 2px 6px rgba(255, 77, 79, 0.6);
        }
        .btn-danger:hover {
            background-color: var(--btn-danger-hover-bg);
        }

        .btn-ghost {
            background: transparent;
            border: 1px solid var(--accent);
            color: var(--accent);
            padding: 8px 10px;
            font-weight: 500;
        }
        .btn-ghost:hover {
            background: var(--accent);
            color: #041014;
        }

        .btn-secondary {
            background: var(--btn-secondary-bg);
            color: var(--accent);
            border: 1px solid var(--accent);
            padding: 8px 14px;
            font-weight: 600;
        }
        .btn-secondary:hover {
            background-color: var(--accent);
            color: #041014;
        }

        .small {
            font-size: 13px;
            color: var(--muted);
        }

        .two-col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        pre.ioc {
            background: #021014;
            border: 1px solid rgba(0, 245, 160, 0.05);
            padding: 8px;
            border-radius: 8px;
            color: #bfffe0;
            overflow: auto;
        }

        .heatmap {
            height: 260px;
            border-radius: 8px;
            background: linear-gradient(180deg, #03171a, #021012);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--muted);
            border: 1px dashed rgba(0, 245, 160, 0.06);
            font-style: italic;
            font-size: 1rem;
            text-align: center;
        }

        .list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .list li {
            padding: 8px;
            border-bottom: 1px dashed rgba(255, 255, 255, 0.03);
        }

        .playbook .section {
            margin-top: 8px;
            border-top: 1px dashed rgba(255, 255, 255, 0.03);
            padding-top: 8px;
        }

        .toast {
            position: fixed;
            right: 20px;
            bottom: 20px;
            background: rgba(0, 0, 0, 0.6);
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid rgba(0, 245, 160, 0.08);
            color: #eafff0;
            font-weight: 600;
            box-shadow: 0 0 15px var(--accent);
            z-index: 1000;
            max-width: 320px;
            word-break: break-word;
        }

        @media (max-width: 1100px) {
            .layout {
                grid-template-columns: 1fr;
            }
            .header {
                justify-content: center;
                gap: 8px;
                text-align: center;
            }
        }

        /* New header button group */
        .header-buttons {
            display: flex;
            gap: 12px;
            align-items: center;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="header">
            <div>
                <h1>SOC — Security Operations Center</h1>
                <div class="muted">Surveillance en temps réel · containment · playbooks</div>
            </div>

            <div class="header-buttons">
                <div class="small">Score sécurité: <strong id="sec-score">—</strong></div>
                <button class="btn" onclick="refreshAll()" aria-label="Rafraîchir toutes les données">Rafraîchir</button>
                <button class="btn btn-secondary" onclick="goHome()" aria-label="Retour à la page d'accueil">Accueil</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger" aria-label="Déconnexion">Déconnexion</button>
                </form>
            </div>
        </div>

        <div class="layout">
            <main>
                <section class="panel">
                    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px">
                        <div>
                            <strong>Threat Feed (live)</strong>
                            <div class="muted">Flux d'alertes push — source: WebSocket /api/security/alerts/recent</div>
                        </div>
                        <div class="small">Dernier: <span id="last-alert-time">—</span></div>
                    </div>

                    <div id="threat-feed" class="feed" aria-live="polite" tabindex="0"></div>
                    <div style="margin-top:8px" class="small">Actions rapides: block IP (multi-step & 2FA) · create ticket · escalate</div>
                </section>

                <section class="panel" style="margin-top:12px">
                    <div class="two-col">
                        <div>
                            <strong>Heatmap géographique</strong>
                            <div class="muted">Attaques dernières 24h · source: /api/security/geo/attacks?last=24h</div>
                            <div class="heatmap" id="heatmap" aria-label="Carte des attaques récentes">Carte interactive (placeholder)</div>
                        </div>

                        <div>
                            <strong>Top 10 IPs suspects</strong>
                            <div class="muted">Quick block</div>
                            <ul class="list" id="top-ips-list"></ul>
                        </div>
                    </div>
                </section>

                <section class="panel" style="margin-top:12px">
                    <strong>Vulnerability Findings</strong>
                    <div class="muted">Reported by: hacker/dev/bounty — /api/security/findings</div>
                    <ul class="list" id="findings-list" style="margin-top:8px"></ul>
                </section>
            </main>

            <aside>
                <section class="panel">
                    <strong>WAF / Firewall (view only)</strong>
                    <div class="muted">Recent rule matches</div>
                    <div id="waf-matches" style="margin-top:8px" class="small" aria-live="polite">Chargement...</div>
                </section>

                <section class="panel" style="margin-top:12px">
                    <strong>Playbook rapide</strong>
                    <div class="muted">Runbooks: DDoS · Data breach · Compromise</div>
                    <div class="playbook">
                        <div class="section">
                            <details>
                                <summary>DDoS — Containment</summary>
                                <div class="small">Actions: blackhole, rate-limit, contact infra</div>
                            </details>
                        </div>
                        <div class="section">
                            <details>
                                <summary>Data breach</summary>
                                <div class="small">Actions: isolate, preserve evidence, notify legal</div>
                            </details>
                        </div>
                        <div class="section">
                            <details>
                                <summary>Suspicious login</summary>
                                <div class="small">Actions: force reset, block IP, review logs</div>
                            </details>
                        </div>
                    </div>
                </section>

                <section class="panel" style="margin-top:12px">
                    <strong>Audit trail (actions)</strong>
                    <div class="muted">Toutes les actions block/unblock/annotate sont tracées</div>
                    <div id="audit-list" style="max-height:260px;overflow:auto;margin-top:8px" class="small" aria-live="polite">Chargement...</div>
                    <div style="margin-top:8px"><button class="btn" onclick="exportAudit()">Télécharger rapport</button></div>
                </section>
            </aside>
        </div>
    </div>

    <div id="toast-container" aria-live="assertive" aria-atomic="true"></div>

    <script>
        // Helpers
        function toast(msg, critical = false) {
            const d = document.createElement('div');
            d.className = 'toast';
            d.textContent = msg;
            if (critical) d.style.border = '1px solid var(--danger)';
            document.getElementById('toast-container').appendChild(d);
            setTimeout(() => d.remove(), 7000);
        }

        async function refreshAll() {
            fetchScore();
            loadTopIPs();
            loadFindings();
            loadWaf();
            loadAudit();
            loadHeatmap();
        }

        async function fetchScore() {
            try {
                const s = await fetch('/api/security/score').then(r => r.json());
                document.getElementById('sec-score').textContent = s.score || '—';
            } catch (e) {
                console.error(e);
            }
        }

        // Threat feed (WebSocket or fallback polling)
        let ws = null;

        function initThreatFeed() {
            try {
                ws = new WebSocket((location.protocol === 'https:' ? 'wss://' : 'ws://') + location.host + '/ws/security/alerts');
                ws.onmessage = e => handleAlert(JSON.parse(e.data));
                ws.onopen = () => console.log('ws open');
                ws.onerror = () => {
                    console.warn('ws error, fallback to polling');
                    pollAlerts();
                };
                ws.onclose = () => {
                    console.warn('ws closed, fallback to polling');
                    pollAlerts();
                };
            } catch (err) {
                console.warn('ws init failed', err);
                pollAlerts();
            }
        }

        async function pollAlerts() {
            try {
                const a = await fetch('/api/security/alerts/recent?limit=50').then(r => r.json());
                a.reverse().forEach(handleAlert);
                setTimeout(pollAlerts, 7000);
            } catch (e) {
                console.error(e);
                setTimeout(pollAlerts, 10000);
            }
        }

        function handleAlert(alert) {
            const feed = document.getElementById('threat-feed');
            const el = document.createElement('div');
            el.className = 'alert-item';
            const sev = (alert.severity || 'low').toLowerCase();
            const sevClass = sev === 'critical' ? 'severity-critical' : (sev === 'high' ? 'severity-high' : (sev === 'medium' ? 'severity-med' : 'severity-low'));

            // Échappement HTML corrigé
            function escapeHtml(s) {
                if (!s) return '';
                return String(s).replace(/[&<>"']/g, c => ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#39;'
                })[c]);
            }

            el.innerHTML = `<div><strong style="color:var(--accent)">${escapeHtml(alert.type||'Alert')}</strong>
            <div class="small">${escapeHtml(alert.target||'—')} · ${escapeHtml(alert.ip||'—')} · ${escapeHtml(alert.country||'—')}</div></div>
            <div style="text-align:right">
                <div class="${sevClass}">${(alert.severity||'').toUpperCase()}</div>
                <div class="actions" style="margin-top:6px">
                    <button class="btn" onclick="blockIp('${alert.ip}')">Block</button>
                    <button class="btn" onclick='createTicket(${encodeURIComponent(JSON.stringify(alert))})'>Ticket</button>
                    <button class="btn btn-danger" onclick='escalateToDirector(${encodeURIComponent(JSON.stringify(alert))})'>Escalate</button>
                </div>
            </div>`;
            feed.prepend(el);
            document.getElementById('last-alert-time').textContent = new Date().toLocaleTimeString();
            if (alert.severity && alert.severity.toLowerCase() === 'critical') {
                toast('Critical alert: ' + (alert.type || ''), true);
                try {
                    new Audio('/sounds/alert.mp3').play().catch(() => {});
                } catch (e) {}
            }
        }

        // Block IP: multi-step confirm + 2FA
        async function blockIp(ip) {
            if (!ip) {
                alert('IP manquante');
                return;
            }
            if (!confirm('Bloquer l\'IP ' + ip + ' ? (confirm)')) return;
            const code = prompt('Entrez code 2FA pour valider le blocage:');
            if (!code) return alert('2FA requis');
            try {
                const res = await fetch('/api/security/block-ip', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({ip, two_factor: code})
                });
                if (!res.ok) throw new Error('block failed');
                toast('IP bloquée: ' + ip);
                loadTopIPs();
                loadAudit();
            } catch (e) {
                console.error(e);
                alert('Échec du blocage');
            }
        }

        function createTicket(alertEncoded) {
            try {
                const alert = JSON.parse(decodeURIComponent(alertEncoded)); // open modal or call API
                fetch('/api/security/tickets', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({title: alert.type, details: alert})
                }).then(r => {
                    if (r.ok) toast('Ticket créé');
                }).catch(e => console.error(e));
            } catch (e) {
                console.error(e);
            }
        }

        function escalateToDirector(alertEncoded) {
            try {
                const alert = JSON.parse(decodeURIComponent(alertEncoded));
                fetch('/api/security/escalate', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify({alert})
                }).then(r => {
                    if (r.ok) toast('Escalated to director');
                });
            } catch (e) {
                console.error(e);
            }
        }

        // Top IPs
        async function loadTopIPs() {
            try {
                const list = await fetch('/api/security/top-ips?limit=10').then(r => r.json());
                const ul = document.getElementById('top-ips-list');
                ul.innerHTML = '';
                if (!list || !list.length) {
                    ul.innerHTML = '<li class="small">Aucun IP suspect</li>';
                    return;
                }
                list.forEach(i => {
                    const li = document.createElement('li');
                    li.innerHTML = `<div style="display:flex;justify-content:space-between;align-items:center">
                        <div><strong>${i.ip}</strong><div class="small">${i.count} hits · ${i.first_seen}</div></div>
                        <div><button class="btn" onclick="blockIp('${i.ip}')">Block</button></div>
                    </div>`;
                    ul.appendChild(li);
                });
            } catch (e) {
                console.error(e);
            }
        }

        // Findings
        async function loadFindings() {
            try {
                const f = await fetch('/api/security/findings').then(r => r.json());
                const ul = document.getElementById('findings-list');
                ul.innerHTML = '';
                if (!f || !f.length) {
                    ul.innerHTML = '<li class="small">Aucun finding</li>';
                    return;
                }
                f.forEach(it => {
                    const li = document.createElement('li');
                    li.innerHTML = `<div style="display:flex;justify-content:space-between;align-items:center">
                        <div>
                            <strong>${escapeHtml(it.title)}</strong>
                            <div class="small">Severity: ${it.severity} · Status: ${it.status} · Assigned: ${it.assigned_to||'—'}</div>
                        </div>
                        <div class="actions">
                            <button class="btn" onclick="copyIOC(${encodeURIComponent(JSON.stringify(it.ioc||{}))})">Copy IOC</button>
                            <button class="btn btn-ghost" onclick="markResolved(${it.id})">Resolve</button>
                        </div>
                    </div>
                    <div class="small" style="margin-top:6px">${escapeHtml(it.summary || '')}</div>`;
                    ul.appendChild(li);
                });
            } catch (e) {
                console.error(e);
            }
        }

        function copyIOC(iocEncoded) {
            try {
                const obj = JSON.parse(decodeURIComponent(iocEncoded));
                const str = JSON.stringify(obj, null, 2);
                navigator.clipboard.writeText(str).then(() => toast('IOC copied'));
            } catch (e) {
                console.error(e);
            }
        }

        async function markResolved(id) {
            if (!confirm('Marquer comme résolu ?')) return;
            try {
                await fetch('/api/security/findings/' + id + '/resolve', {
                    method: 'PATCH'
                });
                toast('Marked resolved');
                loadFindings();
            } catch (e) {
                console.error(e);
            }
        }

        // WAF
        async function loadWaf() {
            try {
                const w = await fetch('/api/security/waf/matches?limit=10').then(r => r.json());
                document.getElementById('waf-matches').textContent = w.length ? w.map(x => x.rule + ' · ' + x.count).join('\n') : 'Aucun match récent';
            } catch (e) {
                console.error(e);
            }
        }

        async function loadAudit() {
            try {
                const a = await fetch('/api/security/audit?limit=50').then(r => r.json());
                const el = document.getElementById('audit-list');
                el.innerHTML = '';
                if (!a || !a.length) {
                    el.textContent = 'Aucun audit récent';
                    return;
                }
                a.forEach(it => {
                    const d = document.createElement('div');
                    d.className = 'small';
                    d.textContent = `${it.created_at} · ${it.actor||'system'} · ${it.action} ${it.target?('· '+it.target):''}`;
                    el.appendChild(d);
                });
            } catch (e) {
                console.error(e);
            }
        }

        function exportAudit() {
            window.location.href = '/api/security/audit/export';
        }

        // Heatmap placeholder
        async function loadHeatmap() {
            try {
                const g = await fetch('/api/security/geo/attacks?last=24h').then(r => r.json());
                const el = document.getElementById('heatmap');
                el.textContent = g.length ? (g.length + ' attack points') : 'No attacks';
            } catch (e) {
                console.error(e);
            }
        }

        // escapeHtml corrigé pour l'ensemble du script
        function escapeHtml(s) {
            if (!s) return '';
            return String(s).replace(/[&<>"']/g, (c) => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                '\'': '&#39;'
            })[c]);
        }

        // Boutons ajoutés

        // Redirection vers la page d'accueil
        function goHome() {
            window.location.href = '/'; // Modifier si la page d'accueil a une autre URL
        }

        // Déconnexion (simulation, à adapter selon back-end)
        async function logout() {
            if (!confirm('Voulez-vous vraiment vous déconnecter ?')) return;
            try {
                const res = await fetch('/logout', {method: 'POST', credentials: 'same-origin'});
                if (res.ok) {
                    toast('Déconnecté avec succès');
                    setTimeout(() => window.location.href = '/login', 1000); // Redirige vers login après déconnexion
                } else {
                    alert('Échec de la déconnexion');
                }
            } catch (e) {
                console.error(e);
                alert('Erreur lors de la déconnexion');
            }
        }

        // Init
        (function init() {
            fetchScore();
            initThreatFeed();
            loadTopIPs();
            loadFindings();
            loadWaf();
            loadAudit();
            loadHeatmap();
        })();
    </script>
</body>
</html>
