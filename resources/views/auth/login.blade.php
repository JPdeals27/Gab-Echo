<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Connexion — GabonÉcho</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* ------------------------------------------- */
        /* 1. FONDATIONS ET VARIABLES DU THÈME (NOUVEAU STYLE) */
        /* ------------------------------------------- */
        :root {
            /* Palette de couleurs plus vivante et moderne */
            --color-primary: #6F89F9; /* Bleu violet doux */
            --color-primary-dark: #5A70D8; /* Bleu violet plus foncé */
            --color-accent: #00BFB3; /* Turquoise vif */
            --color-accent-light: #4DCCCC; /* Turquoise plus clair pour dégradés */
            --color-danger: #FF6B6B; /* Rouge alerte */

            /* Couleurs de fond/texte */
            --color-bg: #FFFFFF; /* Fond principal blanc */
            --color-bg-alt: #F0F4F8; /* Fond alternatif très clair */
            --color-text: #344767; /* Texte principal foncé */
            --color-text-muted: #8392AB; /* Texte secondaire gris bleu */

            /* Input & Focus */
            --input-bg: var(--color-bg);
            --input-border: #E0E7FF; /* Bordure des inputs plus douce */
            --input-focus-border: var(--color-primary);

            /* Ombres plus douces et profondes */
            --shadow-subtle: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-medium: 0 10px 30px rgba(0, 0, 0, 0.12);
            --shadow-strong: 0 20px 60px rgba(0, 0, 0, 0.18);

            /* Rayon de courbure généreux */
            --border-radius: 12px;
            --border-radius-large: 24px;
            --border-radius-xl: 50px; /* Pour les boutons très arrondis */
        }

        /* Reset de base */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: var(--color-bg-alt);
            color: var(--color-text);
            overflow-x: hidden;
            position: relative;
        }

        a {
            color: var(--color-primary);
            text-decoration: none;
            transition: color 0.3s ease, transform 0.2s ease;
        }

        a:hover {
            color: var(--color-primary-dark);
            text-decoration: underline;
            transform: translateY(-1px);
        }

        /* ------------------------------------------- */
        /* 2. ANIMATION ET CONTEXTE VISUEL */
        /* ------------------------------------------- */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: -2;
            background: linear-gradient(135deg, var(--color-bg-alt) 0%, #DDE6F0 100%);
        }

        .shape {
            position: absolute;
            background: linear-gradient(135deg, var(--color-primary), var(--color-accent-light));
            border-radius: 50%;
            opacity: 0.2;
            filter: blur(80px);
            animation: float 15s infinite ease-in-out alternate;
        }

        .shape-1 {
            width: 400px;
            height: 400px;
            top: -100px;
            left: -100px;
            animation-duration: 18s;
            animation-delay: 0s;
            background: linear-gradient(135deg, var(--color-primary), var(--color-accent));
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            bottom: -80px;
            right: -80px;
            animation-duration: 22s;
            animation-delay: 2s;
            background: linear-gradient(135deg, var(--color-accent-light), var(--color-primary));
        }

        .shape-3 {
            width: 200px;
            height: 200px;
            top: 50%;
            left: 10%;
            animation-duration: 20s;
            animation-delay: 4s;
            background: linear-gradient(135deg, var(--color-primary-dark), var(--color-accent-light));
            opacity: 0.15;
        }
         .shape-4 {
            width: 250px;
            height: 250px;
            bottom: 15%;
            left: 15%;
            animation-duration: 25s;
            animation-delay: 1s;
            background: linear-gradient(135deg, var(--color-accent), var(--color-primary-dark));
            opacity: 0.1;
        }


        @keyframes float {
            0% {
                transform: translate(0, 0) scale(1);
            }
            50% {
                transform: translate(30px, -30px) scale(1.05);
            }
            100% {
                transform: translate(0, 0) scale(1);
            }
        }


        /* ------------------------------------------- */
        /* 3. WRAPPER ET TYPOGRAPHIE (DISPOSITION CORRIGÉE) */
        /* ------------------------------------------- */
        .page-wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            justify-content: space-between; /* Pousse le footer vers le bas */
            padding: 0;
            position: relative;
            z-index: 1;
        }

        .main-content {
            flex-grow: 1; /* Permet à la zone principale de prendre l'espace */
            display: flex;
            align-items: center; /* Centre le formulaire verticalement */
            justify-content: center; /* Centre le formulaire horizontalement */
            padding: 2rem 0; /* Ajoute du padding vertical pour les écrans plus courts */
        }

        /* Conteneur principal du formulaire - Style "carte flottante" */
        .wrap {
            position: relative;
            width: 90%;
            max-width: 450px;
            background: var(--color-bg);
            padding: 3.5rem 2.5rem;
            border-radius: var(--border-radius-large);
            box-shadow: var(--shadow-medium);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            z-index: 10;
        }

        .wrap:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-strong);
        }

        h1 {
            margin: 0 0 0.75rem;
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 2.5rem;
            text-align: center;
            color: var(--color-primary-dark);
            background: -webkit-linear-gradient(45deg, var(--color-primary), var(--color-primary-dark));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.05em;
        }

        .subtitle {
            text-align: center;
            color: var(--color-text-muted);
            margin-bottom: 3rem;
            font-size: 1.05rem;
            line-height: 1.5;
        }

        /* ------------------------------------------- */
        /* 4. FORMULAIRE ET CHAMPS */
        /* ------------------------------------------- */
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.6rem;
            font-size: 0.9rem;
            color: var(--color-text);
            opacity: 0.8;
        }

        .required {
            color: var(--color-danger);
            margin-left: 0.25rem;
        }

        .field {
            margin-bottom: 1.75rem;
        }

        .input-group {
            position: relative;
            display: flex;
            align-items: center;
            border-bottom: 2px solid var(--input-border);
            transition: border-color 0.3s ease;
        }

        .input-group:focus-within {
             border-color: var(--input-focus-border);
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 1rem 0.5rem 1rem 3rem;
            font-size: 1rem;
            border: none;
            background: transparent;
            font-weight: 500;
            color: var(--color-text);
            outline: none;
            flex-grow: 1;
        }

        input::placeholder {
            color: var(--color-text-muted);
            opacity: 0.6;
        }

        /* Icônes à l'intérieur des champs */
        .input-group .icon {
            position: absolute;
            left: 0.75rem;
            color: var(--color-text-muted);
            font-size: 1.1rem;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .input-group:focus-within .icon {
            color: var(--color-primary);
        }

        /* Bouton "Voir / Cacher" du mot de passe - Intégré */
        .toggle-btn {
            background: transparent;
            border: none;
            padding: 0.5rem;
            color: var(--color-text-muted);
            cursor: pointer;
            font-size: 1rem;
            transition: color 0.3s ease, transform 0.2s ease;
            flex-shrink: 0;
        }

        .toggle-btn:hover {
            color: var(--color-primary);
            transform: translateY(-1px);
        }


        /* ------------------------------------------- */
        /* 5. Messages & Actions */
        /* ------------------------------------------- */
        .message-box {
            padding: 1rem;
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
            font-weight: 500;
            font-size: 0.9rem;
            display: none;
            align-items: center;
            gap: 0.75rem;
            border: 1px solid transparent;
            box-shadow: var(--shadow-subtle);
        }

        .message-box.active {
            display: flex;
        }

        .message-error {
            background: #FFEDED;
            color: var(--color-danger);
            border-color: var(--color-danger);
        }

        /* Affichage des erreurs */
        .error {
            font-size: 0.8rem;
            margin-top: 0.5rem;
            color: var(--color-danger);
            font-weight: 500;
        }

        /* Style pour l'input en erreur */
        input.input-error {
            /* Garde ce style pour l'input-group */
        }
        .input-group.input-error {
            border-bottom-color: var(--color-danger) !important;
        }

        /* Section Rester connecté / Mot de passe oublié */
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .actions label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            user-select: none;
            font-weight: 500;
            color: var(--color-text-muted);
            margin-bottom: 0;
        }

        .actions input[type="checkbox"] {
            width: 18px;
            height: 18px;
            cursor: pointer;
            accent-color: var(--color-primary);
            border-radius: 4px;
            margin: 0;
            flex-shrink: 0;
            border: 1px solid var(--input-border);
            transition: all 0.2s ease;
        }

        .actions input[type="checkbox"]:checked {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(111, 137, 249, 0.2);
        }

        .actions a.link {
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* Bouton de soumission principal */
        button[type="submit"] {
            width: 100%;
            background: linear-gradient(90deg, var(--color-accent), var(--color-primary));
            color: #fff;
            font-weight: 700;
            font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem;
            padding: 1rem 0;
            border-radius: var(--border-radius-xl);
            border: none;
            cursor: pointer;
            box-shadow: 0 10px 25px rgba(0, 191, 179, 0.3);
            transition: all 0.3s ease;
            user-select: none;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            text-transform: uppercase;
        }

        button[type="submit"]:hover,
        button[type="submit"]:focus {
            background: linear-gradient(90deg, var(--color-accent-light), var(--color-primary-dark));
            transform: translateY(-2px);
            outline: none;
            box-shadow: 0 12px 30px rgba(0, 191, 179, 0.4);
        }

        button[type="submit"] i {
            font-size: 1rem;
        }

        /* ------------------------------------------- */
        /* 6. CONNEXION SOCIALE ET PIED DE PAGE MINIMALISTE */
        /* ------------------------------------------- */
        .or-divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--color-text-muted);
            margin: 2.5rem 0;
            font-size: 0.85rem;
        }

        .or-divider::before,
        .or-divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid var(--input-border);
        }

        .or-divider:not(:empty)::before {
            margin-right: .75rem;
        }

        .or-divider:not(:empty)::after {
            margin-left: .75rem;
        }

        .btn-social {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 0.9rem 0;
            border-radius: var(--border-radius-xl);
            font-weight: 600;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            border: 1px solid var(--input-border);
            background: var(--color-bg);
            color: var(--color-text);
            box-shadow: var(--shadow-subtle);
        }

        .btn-social i {
            font-size: 1.1rem;
            margin-right: 0.75rem;
        }

        .btn-social.google:hover {
            background: var(--color-bg-alt);
            border-color: #C0CCE0;
            transform: translateY(-1px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        /* Lien Retour et Pas de compte */
        .register-link,
        .return-link {
            text-align: center;
            margin-top: 2.5rem;
            font-size: 0.95rem;
            color: var(--color-text-muted);
        }

        .return-link {
            margin-top: 1.5rem;
            font-size: 0.9rem;
        }

        .return-link a {
            color: var(--color-text-muted);
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .return-link a:hover {
            color: var(--color-primary-dark);
            text-decoration: none;
        }

        /* ------------------------------------------- */
        /* 7. FOOTER MINIMALISTE (Restauré et positionné en bas) */
        /* ------------------------------------------- */
        footer {
            padding: 1.5rem 0;
            text-align: center;
            font-size: 0.8rem;
            color: var(--color-text-muted);
            border-top: 1px solid var(--input-border);
            background-color: var(--color-bg);
            position: relative;
            z-index: 10;
        }

        .footer-links a {
            color: var(--color-text-muted);
            margin: 0 0.6rem;
        }

        .footer-links a:hover {
            color: var(--color-primary);
            text-decoration: underline;
        }

        /* ------------------------------------------- */
        /* 8. RESPONSIVITÉ (Ajustée pour la visibilité) */
        /* ------------------------------------------- */
        @media (max-width: 600px) {
            .page-wrapper {
                justify-content: flex-start; /* Permet au contenu de s'afficher depuis le haut */
            }

            .main-content {
                padding: 1rem 0; /* Padding réduit sur mobile */
            }

            .wrap {
                padding: 2.5rem 1.5rem;
                max-width: 100%;
                border-radius: 0;
                box-shadow: none;
                margin: 0;
                min-height: auto; /* Laisse le contenu définir la hauteur */
            }

            h1 {
                font-size: 2rem;
            }

            .subtitle {
                margin-bottom: 2rem;
            }

            .actions {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
                margin-bottom: 2rem;
            }

            footer {
                margin-top: 0;
                background-color: var(--color-bg); /* S'assure que le footer a un fond blanc */
            }
        }

    </style>
</head>
<body class="page-wrapper">

<div class="animated-bg">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
    </div>

    <div class="main-content">
        <div class="wrap" role="main" aria-labelledby="pageTitle">
            <h1 id="pageTitle">Bienvenue</h1>
            <p class="subtitle">Connectez-vous à votre compte pour continuer.</p>

            <div id="status-message" class="message-box" role="alert" aria-live="assertive">
                <i class="fas fa-exclamation-circle"></i>
                <span id="message-text"></span>
            </div>

            <form id="login-form" method="POST" action="{{ route('login') }}" novalidate>
                @csrf
                <div class="field">
                    <label for="email">Email ou Téléphone <span class="required">*</span></label>
                    <div class="input-group">
                        <i class="fas fa-at icon" aria-hidden="true"></i>
                        <input id="email" name="email" type="text" value="{{ old('email') }}" placeholder="Adresse email ou numéro de téléphone" required autofocus aria-required="true" autocomplete="username" />
                    </div>
                    <div class="client-error error" id="email-error" aria-hidden="true" style="display: none;"></div>
                </div>

                <div class="field">
                    <label for="password">Mot de passe <span class="required">*</span></label>
                    <div class="input-group password-group">
                        <i class="fas fa-lock icon" aria-hidden="true"></i>
                        <input id="password" name="password" type="password" placeholder="Minimum 6 caractères" required aria-required="true" autocomplete="current-password" />
                        <button type="button" class="toggle-btn" aria-label="Afficher ou masquer le mot de passe" onclick="togglePassword('password', this)">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="client-error error" id="password-error" aria-hidden="true" style="display: none;"></div>
                </div>

                <div class="actions">
                    <label for="remember">
                        <input type="checkbox" id="remember" name="remember" /> Se souvenir de moi
                    </label>
                    <a class="link" href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                </div>

                <button type="submit">
                    <i class="fas fa-arrow-right-to-bracket"></i> Se connecter
                </button>
            </form>

            <div class="or-divider">ou</div>

            <a href="#" class="btn-social google" aria-label="Se connecter avec Google">
                <i class="fab fa-google"></i> Continuer avec Google
            </a>

            <div class="register-link">
                Vous n'avez pas de compte ?
                <a href="{{ route('register') }}" class="link">Créer un compte</a>
            </div>

            <div class="return-link">
                 <a href="{{ url('/') }}" aria-label="Retour à la page d'accueil">
                    <i class="fas fa-home"></i> Retour à l'accueil
                </a>
            </div>
        </div>
    </div>

    <footer>
        <div class="footer-links">
            <a href="{{ route('privacy') }}">Politique de confidentialité</a> |
            <a href="{{ route('terms') }}">Conditions d'utilisation</a>
        </div>
        &copy; 2025 GabonÉcho. Tous droits réservés.
    </footer>

    <script>
        // ----------------------------------------------------
        // 1. FONCTIONNALITÉ VOIR/CACHER MOT DE PASSE
        // ----------------------------------------------------
        function togglePassword(id, btn) {
            const el = document.getElementById(id);
            const icon = btn.querySelector('.fa-eye, .fa-eye-slash');

            if (!el || !icon) return;

            if (el.type === 'password') {
                el.type = 'text';
                icon.className = 'fas fa-eye-slash'; // Icône pour Cacher
                btn.setAttribute('aria-label', 'Masquer le mot de passe');
            } else {
                el.type = 'password';
                icon.className = 'fas fa-eye'; // Icône pour Voir
                btn.setAttribute('aria-label', 'Afficher le mot de passe');
            }
        }

        // ----------------------------------------------------
        // 2. LOGIQUE DE VALIDATION CÔTÉ CLIENT
        // ----------------------------------------------------

        function showClientError(el, message) {
            el.classList.add('input-error');
            el.closest('.input-group').classList.add('input-error');
            el.setAttribute('aria-invalid', 'true');

            const errorDiv = el.closest('.field').querySelector('.client-error');
            if (errorDiv) {
                errorDiv.textContent = message;
                errorDiv.style.display = 'block';
                errorDiv.setAttribute('aria-hidden', 'false');
            }
        }

        function clearClientErrors() {
            document.querySelectorAll('input.input-error').forEach(n => {
                n.classList.remove('input-error');
                n.removeAttribute('aria-invalid');
                n.closest('.input-group')?.classList.remove('input-error');
            });
            document.querySelectorAll('.client-error').forEach(n => {
                n.textContent = '';
                n.style.display = 'none';
                n.setAttribute('aria-hidden', 'true');
            });

            const statusBox = document.getElementById('status-message');
            statusBox.classList.remove('active', 'message-error', 'message-success');
        }

        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('login-form');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');

            form && form.addEventListener('submit', function (e) {
                let isValid = true;
                clearClientErrors();

                if (!emailInput.value.trim()) {
                    showClientError(emailInput, "L'email ou le téléphone est requis.");
                    isValid = false;
                }

                if (!passwordInput.value || passwordInput.value.length < 6) {
                    showClientError(passwordInput, "Le mot de passe doit contenir au moins 6 caractères.");
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();

                    const statusBox = document.getElementById('status-message');
                    const messageText = document.getElementById('message-text');
                    messageText.textContent = "Veuillez corriger les champs en rouge ci-dessous.";
                    statusBox.classList.add('active', 'message-error');

                    document.querySelector('.input-error')?.focus();
                }
            });

            emailInput?.addEventListener('input', () => {
                if (emailInput.value.trim()) {
                    emailInput.classList.remove('input-error');
                    emailInput.removeAttribute('aria-invalid');
                    emailInput.closest('.input-group')?.classList.remove('input-error');
                    document.getElementById('email-error').style.display = 'none';
                }
            });

            passwordInput?.addEventListener('input', () => {
                if (passwordInput.value.length >= 6) {
                    passwordInput.classList.remove('input-error');
                    passwordInput.removeAttribute('aria-invalid');
                    passwordInput.closest('.input-group')?.classList.remove('input-error');
                    document.getElementById('password-error').style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
