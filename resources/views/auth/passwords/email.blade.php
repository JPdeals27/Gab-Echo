
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Mot de passe oublié — GabonÉcho</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* ------------------------------------------- */
        /* 1. FONDATIONS ET VARIABLES DU THÈME */
        /* ------------------------------------------- */
        :root {
            /* Variables réutilisées de la page de connexion */
            --color-primary: #6F89F9;
            --color-primary-dark: #5A70D8;
            --color-accent: #00BFB3;
            --color-accent-light: #4DCCCC;
            --color-danger: #FF6B6B;

            --color-bg: #FFFFFF;
            --color-bg-alt: #F0F4F8;
            --color-text: #344767;
            --color-text-muted: #8392AB;

            --input-bg: var(--color-bg);
            --input-border: #E0E7FF;
            --input-focus-border: var(--color-primary);

            --shadow-subtle: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-medium: 0 10px 30px rgba(0, 0, 0, 0.12);
            --shadow-strong: 0 20px 60px rgba(0, 0, 0, 0.18);

            --border-radius: 12px;
            --border-radius-large: 24px;
            --border-radius-xl: 50px;
        }

        /* Reset et style de base */
        *, *::before, *::after { box-sizing: border-box; }
        html, body {
            margin: 0; padding: 0; height: 100%;
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
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            overflow: hidden; z-index: -2;
            background: linear-gradient(135deg, var(--color-bg-alt) 0%, #DDE6F0 100%);
        }

        .shape {
            position: absolute; border-radius: 50%; opacity: 0.2;
            filter: blur(80px); animation: float 15s infinite ease-in-out alternate;
        }
        .shape-1 { background: linear-gradient(135deg, var(--color-primary), var(--color-accent)); width: 400px; height: 400px; top: -100px; left: -100px; animation-duration: 18s; animation-delay: 0s; }
        .shape-2 { background: linear-gradient(135deg, var(--color-accent-light), var(--color-primary)); width: 300px; height: 300px; bottom: -80px; right: -80px; animation-duration: 22s; animation-delay: 2s; }
        .shape-3 { background: linear-gradient(135deg, var(--color-primary-dark), var(--color-accent-light)); width: 200px; height: 200px; top: 50%; left: 10%; animation-duration: 20s; animation-delay: 4s; opacity: 0.15; }
        .shape-4 { background: linear-gradient(135deg, var(--color-accent), var(--color-primary-dark)); width: 250px; height: 250px; bottom: 15%; left: 15%; animation-duration: 25s; animation-delay: 1s; opacity: 0.1; }

        @keyframes float {
            0% { transform: translate(0, 0) scale(1); }
            50% { transform: translate(30px, -30px) scale(1.05); }
            100% { transform: translate(0, 0) scale(1); }
        }

        /* ------------------------------------------- */
        /* 3. WRAPPER ET TYPOGRAPHIE */
        /* ------------------------------------------- */
        .page-wrapper {
            display: flex; flex-direction: column; min-height: 100vh;
            justify-content: space-between; padding: 0; position: relative; z-index: 1;
        }

        .main-content {
            flex-grow: 1; display: flex; align-items: center; justify-content: center;
            padding: 2rem 0;
        }

        .wrap {
            position: relative; width: 90%; max-width: 450px;
            background: var(--color-bg); padding: 3.5rem 2.5rem;
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
            font-size: 2.2rem; /* Légèrement réduit pour cette page */
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
            font-size: 1rem;
            line-height: 1.5;
        }

        /* ------------------------------------------- */
        /* 4. FORMULAIRE ET CHAMPS */
        /* ------------------------------------------- */
        label {
            display: block; font-weight: 600; margin-bottom: 0.6rem;
            font-size: 0.9rem; color: var(--color-text); opacity: 0.8;
        }
        .required { color: var(--color-danger); margin-left: 0.25rem; }
        .field { margin-bottom: 2rem; }
        .input-group {
            position: relative; display: flex; align-items: center;
            border-bottom: 2px solid var(--input-border);
            transition: border-color 0.3s ease;
        }
        .input-group:focus-within { border-color: var(--input-focus-border); }
        input[type="text"] {
            width: 100%; padding: 1rem 0.5rem 1rem 3rem; font-size: 1rem;
            border: none; background: transparent; font-weight: 500;
            color: var(--color-text); outline: none; flex-grow: 1;
        }
        input::placeholder { color: var(--color-text-muted); opacity: 0.6; }

        /* Icônes */
        .input-group .icon {
            position: absolute; left: 0.75rem; color: var(--color-text-muted);
            font-size: 1.1rem; transition: color 0.3s ease; pointer-events: none;
        }
        .input-group:focus-within .icon { color: var(--color-primary); }

        /* Bouton de soumission */
        button[type="submit"] {
            width: 100%;
            background: linear-gradient(90deg, var(--color-accent), var(--color-primary));
            color: #fff; font-weight: 700; font-family: 'Montserrat', sans-serif;
            font-size: 1.1rem; padding: 1rem 0; border-radius: var(--border-radius-xl);
            border: none; cursor: pointer; box-shadow: 0 10px 25px rgba(0, 191, 179, 0.3);
            transition: all 0.3s ease; user-select: none; letter-spacing: 0.05em;
            display: flex; align-items: center; justify-content: center; gap: 0.75rem;
            text-transform: uppercase;
        }

        button[type="submit"]:hover,
        button[type="submit"]:focus {
            background: linear-gradient(90deg, var(--color-accent-light), var(--color-primary-dark));
            transform: translateY(-2px); outline: none; box-shadow: 0 12px 30px rgba(0, 191, 179, 0.4);
        }

        /* Message de confirmation (après envoi) */
        .message-success {
            padding: 1.5rem; border-radius: var(--border-radius);
            margin-top: 2rem; font-weight: 600; font-size: 1rem;
            display: flex; align-items: center; gap: 1rem;
            background: #e6fff3; color: var(--color-accent);
            border: 1px solid var(--color-accent);
        }
        .message-success i {
            font-size: 1.5rem;
        }

        /* ------------------------------------------- */
        /* 5. LIENS ET FOOTER */
        /* ------------------------------------------- */
        .return-link {
            text-align: center; margin-top: 3rem; font-size: 0.95rem;
            color: var(--color-text-muted);
        }
        .return-link a {
            color: var(--color-text-muted); font-weight: 500;
            display: inline-flex; align-items: center; gap: 0.5rem;
        }
        .return-link a:hover { color: var(--color-primary-dark); text-decoration: none; }

        footer {
            padding: 1.5rem 0; text-align: center; font-size: 0.8rem;
            color: var(--color-text-muted); border-top: 1px solid var(--input-border);
            background-color: var(--color-bg); position: relative; z-index: 10;
        }
        .footer-links a {
            color: var(--color-text-muted); margin: 0 0.6rem;
        }
        .footer-links a:hover { color: var(--color-primary); text-decoration: underline; }

        /* ------------------------------------------- */
        /* 6. RESPONSIVITÉ */
        /* ------------------------------------------- */
        @media (max-width: 600px) {
            .main-content { padding: 1rem 0; }
            .wrap {
                padding: 2.5rem 1.5rem; border-radius: 0; box-shadow: none; margin: 0;
            }
            h1 { font-size: 2rem; }
            .subtitle { margin-bottom: 2rem; }
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

        <h1 id="pageTitle">Mot de passe oublié ?</h1>
        <p class="subtitle">
            Entrez votre adresse email ou votre numéro de téléphone. Nous vous enverrons un lien pour réinitialiser votre mot de passe.
        </p>

        <div id="success-message" class="message-success" style="display: none;">
            <i class="fas fa-check-circle"></i>
            <span id="success-text">Un lien de réinitialisation a été envoyé à votre adresse. Veuillez vérifier votre boîte de réception.</span>
        </div>

        <form id="reset-form" method="POST" action="{{ route('password.email') }}" novalidate>
            @csrf
            <div class="field">
                <label for="email_or_phone">Email ou Téléphone <span class="required">*</span></label>
                <div class="input-group">
                    <i class="fas fa-at icon" aria-hidden="true"></i>
                    <input id="email_or_phone" name="email_or_phone" type="text" placeholder="Entrez votre email ou numéro" required autofocus aria-required="true" autocomplete="email" />
                </div>
                <div class="client-error error" id="email_or_phone-error" aria-hidden="true" style="display: none;"></div>
            </div>

            <button type="submit" id="submit-btn">
                <i class="fas fa-paper-plane"></i> Envoyer le lien de réinitialisation
            </button>
        </form>

        <div class="return-link">
             <a href="{{ route('login') }}" aria-label="Retour à la page de connexion">
                <i class="fas fa-arrow-left"></i> Retour à la connexion
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
    // LOGIQUE DE VALIDATION ET SIMULATION D'ENVOI CÔTÉ CLIENT
    // ----------------------------------------------------

    // Helper functions (Réutilisées de la page de connexion)
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
    }

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('reset-form');
        const input = document.getElementById('email_or_phone');
        const submitBtn = document.getElementById('submit-btn');
        const successMessage = document.getElementById('success-message');

        form && form.addEventListener('submit', function (e) {
            e.preventDefault(); // Empêche l'envoi réel pour la démonstration
            let isValid = true;
            clearClientErrors();

            if (!input.value.trim()) {
                showClientError(input, "Veuillez entrer votre email ou votre numéro de téléphone.");
                isValid = false;
            } else {
                // Simulation d'une validation simple (nécessiterait une regex complète en prod)
                const value = input.value.trim();
                const isEmail = value.includes('@');
                const isPhone = !isNaN(parseFloat(value)) && isFinite(value);

                if (!isEmail && !isPhone) {
                     showClientError(input, "Format non valide. Entrez un email ou un numéro de téléphone.");
                     isValid = false;
                }
            }

            if (isValid) {
                // ------------------------------------------------
                // SIMULATION DE L'ENVOI RÉUSSI (AJAX)
                // ------------------------------------------------

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Envoi en cours...';

                // Simuler un délai d'attente réseau
                setTimeout(() => {
                    // Cacher le formulaire et montrer le message de succès
                    form.style.display = 'none';
                    successMessage.style.display = 'flex';

                    // Mettre à jour le message si l'on a pu déterminer si c'était un email ou téléphone
                    const value = input.value.trim();
                    if (value.includes('@')) {
                        document.getElementById('success-text').textContent = "Un lien de réinitialisation a été envoyé à l'adresse " + value + ". Veuillez vérifier votre boîte de réception.";
                    } else {
                        document.getElementById('success-text').textContent = "Un code de réinitialisation a été envoyé au numéro de téléphone associé à votre compte.";
                    }

                    // Rétablir le bouton au cas où l'utilisateur revient en arrière (non pertinent ici, mais bonne pratique)
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Envoyer le lien de réinitialisation';

                }, 1500); // 1.5 secondes de délai

            }
        });

        // Effacer l'erreur au fur et à mesure de la saisie
        input?.addEventListener('input', () => {
             if (input.value.trim()) {
                input.classList.remove('input-error');
                input.removeAttribute('aria-invalid');
                input.closest('.input-group')?.classList.remove('input-error');
                document.getElementById('email_or_phone-error').style.display = 'none';
             }
        });
    });
</script>
</body>
</html>
