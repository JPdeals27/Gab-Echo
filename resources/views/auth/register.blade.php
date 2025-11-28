<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Inscription — GabonÉcho</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* ------------------------------------------- */
        /* 1. FONDATIONS ET VARIABLES DU THÈME (HARMONISÉ) */
        /* ------------------------------------------- */
        :root {
            /* Palette de couleurs harmonisée avec les pages précédentes */
            --color-primary: #6F89F9; /* Bleu violet doux */
            --color-primary-dark: #5A70D8; /* Bleu violet plus foncé */
            --color-accent: #00BFB3; /* Turquoise vif (proche de l'ancien accent) */
            --color-accent-light: #4DCCCC;
            --color-danger: #FF6B6B;

            /* Couleurs de fond/texte */
            --color-bg: #FFFFFF;
            --color-bg-alt: #F0F4F8;
            --color-text: #344767;
            --color-text-muted: #8392AB;

            /* Input & Focus */
            --input-bg: var(--color-bg);
            --input-border: #E0E7FF;
            --input-focus-border: var(--color-primary);
            --input-border-error: var(--color-danger);

            /* Ombres plus douces et profondes */
            --shadow-subtle: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-medium: 0 10px 30px rgba(0, 0, 0, 0.12);
            --shadow-strong: 0 20px 60px rgba(0, 0, 0, 0.18);

            /* Rayon de courbure généreux */
            --border-radius: 12px;
            --border-radius-large: 24px;
            --border-radius-xl: 50px;
        }

        /* Reset de base */
        *, *::before, *::after { box-sizing: border-box; }
        html, body {
            margin: 0; padding: 0; height: 100%;
            font-family: 'Poppins', sans-serif;
            background: var(--color-bg-alt);
            color: var(--color-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column; /* Utilisation d'une structure flex pour le body */
            align-items: center;
            justify-content: flex-start; /* Réajustement pour éviter le "trop haut" */
            padding: 1.5rem 0; /* Padding vertical général */
            position: relative;
            overflow-x: hidden;
        }

        a {
            color: var(--color-primary);
            text-decoration: none;
            transition: color 0.3s ease, transform 0.2s ease;
        }

        a:hover {
            color: var(--color-primary-dark);
            text-decoration: underline;
        }

        /* ------------------------------------------- */
        /* 2. ANIMATION ET CONTEXTE VISUEL (REPRISE DU STYLE MAFIQUE) */
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

        .wrap {
            position: relative;
            background: var(--color-bg);
            max-width: 700px; /* Plus large pour accueillir la grille */
            width: 90%;
            border-radius: var(--border-radius-large);
            padding: 3.5rem 2.5rem;
            box-shadow: var(--shadow-medium);
            z-index: 10;
            margin: 1rem 0; /* Marge pour les grands écrans */
        }

        .wrap:hover {
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
            margin-bottom: 2.5rem;
        }

        /* ------------------------------------------- */
        /* 4. FORMULAIRE ET CHAMPS (STYLE LIGNE DE FOND & ICÔNE) */
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

        .row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Grille plus large */
            gap: 1.5rem;
            margin-bottom: 1.75rem; /* Plus d'espace */
        }

        /* Conteneur d'input pour le style ligne de fond */
        .input-container {
            position: relative;
            display: flex;
            align-items: center;
            border-bottom: 2px solid var(--input-border);
            transition: border-color 0.3s ease;
        }

        .input-container:focus-within {
             border-color: var(--input-focus-border);
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 1rem 0.5rem 1rem 3rem; /* Espace pour icône */
            font-size: 1rem;
            border: none;
            background: transparent;
            font-weight: 500;
            color: var(--color-text);
            outline: none;
            flex-grow: 1;
            /* Supprime les bordures complètes inutiles */
            border-radius: 0;
            padding-right: 0.5rem;
        }

        select {
            /* Ajustement pour select */
            padding: 1rem 0.5rem 1rem 3rem;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none; /* Cache la flèche par défaut */
        }

        /* Icône à l'intérieur des champs */
        .input-container .icon {
            position: absolute;
            left: 0.75rem;
            color: var(--color-text-muted);
            font-size: 1.1rem;
            transition: color 0.3s ease;
            pointer-events: none;
        }

        .input-container:focus-within .icon {
            color: var(--color-primary);
        }

        /* Correction pour les champs en erreur */
        .input-container.error {
            border-bottom-color: var(--input-border-error) !important;
        }

        /* Affichage des erreurs */
        .error {
            color: var(--color-danger);
            font-size: 0.8rem;
            margin-top: 0.5rem;
            font-weight: 500;
        }

        /* Password row: Rendre les champs de mot de passe plus lisibles */
        .password-row {
            grid-template-columns: repeat(2, 1fr);
            display: grid;
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }

        /* Bouton afficher/masquer mot de passe - Intégré dans l'input-container */
        .toggle-password {
            background: transparent;
            border: none;
            padding: 0.5rem;
            color: var(--color-text-muted);
            cursor: pointer;
            font-size: 1rem;
            transition: color 0.3s ease, transform 0.2s ease;
            flex-shrink: 0;
            position: absolute; /* Position absolue dans le container */
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            z-index: 1;
        }

        .toggle-password:hover {
            color: var(--color-primary);
            transform: translateY(-50%) scale(1.05);
        }

        /* Sélecteur de Province/Région: Ajout d'un indicateur de flèche custom (puisque 'appearance: none' est utilisé) */
        .select-wrapper {
            position: relative;
        }

        .select-wrapper::after {
            content: "\f078"; /* Flèche vers le bas (Font Awesome) */
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: var(--color-text-muted);
            font-size: 0.8rem;
        }

        /* ------------------------------------------- */
        /* 5. BOUTONS ET LIENS */
        /* ------------------------------------------- */

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
            text-transform: uppercase;
            margin-top: 1.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
        }

        button[type="submit"]:hover,
        button[type="submit"]:focus {
            background: linear-gradient(90deg, var(--color-accent-light), var(--color-primary-dark));
            transform: translateY(-2px);
            outline: none;
            box-shadow: 0 12px 30px rgba(0, 191, 179, 0.4);
        }

        .small {
            font-size: 0.9rem;
            color: var(--color-text-muted);
            margin-top: 0.75rem;
            text-align: center;
        }

        /* Bouton Retour (back-btn) */
        .back-btn {
            position: absolute;
            top: 2rem;
            left: 2rem;
            background: var(--color-bg);
            border: none;
            color: var(--color-primary);
            font-weight: 600;
            padding: 0.6rem 1rem;
            border-radius: var(--border-radius-large);
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            user-select: none;
            box-shadow: var(--shadow-subtle);
        }

        .back-btn:hover {
            color: var(--color-primary-dark);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .back-btn i {
            font-size: 1rem;
        }

        /* ------------------------------------------- */
        /* 6. RESPONSIVITÉ */
        /* ------------------------------------------- */
        @media (max-width: 768px) {
             .row {
                 /* Colonnes empilées sur les petits écrans pour plus de verticalité */
                grid-template-columns: 1fr;
                gap: 1.25rem;
                margin-bottom: 1.25rem;
            }

             .password-row {
                 /* Les mots de passe restent séparés pour une meilleure organisation */
                grid-template-columns: 1fr;
                gap: 1.25rem;
                margin-bottom: 2rem;
            }

            .wrap {
                padding: 2.5rem 1.5rem;
                max-width: 100%;
                border-radius: 0;
                box-shadow: none;
                margin: 0;
            }

            h1 {
                font-size: 2rem;
            }

            .back-btn {
                top: 1rem;
                left: 1rem;
                padding: 0.5rem 0.8rem;
                font-size: 0.9rem;
            }
        }

    </style>
</head>
<body>

    <div class="animated-bg">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        <div class="shape shape-4"></div>
    </div>

    <a href="{{ route('home') }}" class="back-btn" aria-label="Retour à la page d'accueil" title="Retour à l'accueil">
        <i class="fas fa-arrow-left"></i> Accueil
    </a>

    <div class="wrap" role="main" aria-labelledby="pageTitle">
        <h1 id="pageTitle">Créer votre compte</h1>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="row">
                <div>
                    <label for="first_name">Prénom <span class="required">*</span></label>
                    <div class="input-container @error('first_name') error @enderror">
                        <i class="fas fa-user icon" aria-hidden="true"></i>
                        <input id="first_name" name="first_name" type="text" value="{{ old('first_name') }}" required aria-required="true" autocomplete="given-name" aria-describedby="error-first_name" placeholder="Votre prénom" />
                    </div>
                    @error('first_name')<div id="error-first_name" class="error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label for="last_name">Nom <span class="required">*</span></label>
                    <div class="input-container @error('last_name') error @enderror">
                        <i class="fas fa-user-tag icon" aria-hidden="true"></i>
                        <input id="last_name" name="last_name" type="text" value="{{ old('last_name') }}" required aria-required="true" autocomplete="family-name" aria-describedby="error-last_name" placeholder="Votre nom de famille" />
                    </div>
                    @error('last_name')<div id="error-last_name" class="error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div>
                    <label for="date_of_birth">Date de naissance</label>
                    <div class="input-container @error('date_of_birth') error @enderror">
                        <i class="fas fa-calendar-alt icon" aria-hidden="true"></i>
                        <input id="date_of_birth" name="date_of_birth" type="date" value="{{ old('date_of_birth') }}" autocomplete="bday" aria-describedby="error-date_of_birth" />
                    </div>
                    @error('date_of_birth')<div id="error-date_of_birth" class="error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label for="province">Province / Région</label>
                    <div class="input-container select-wrapper @error('province') error @enderror">
                         <i class="fas fa-map-marker-alt icon" aria-hidden="true"></i>
                         <select id="province" name="province" autocomplete="address-level1" aria-describedby="error-province">
                            <option value="">— Sélectionner —</option>
                            <option value="Estuaire" @if(old('province')==='Estuaire' ) selected @endif>Estuaire</option>
                            <option value="Haut-Ogooué" @if(old('province')==='Haut-Ogooué' ) selected @endif>Haut-Ogooué</option>
                            <option value="Moyen-Ogooué" @if(old('province')==='Moyen-Ogooué' ) selected @endif>Moyen-Ogooué</option>
                            <option value="Ngounié" @if(old('province')==='Ngounié' ) selected @endif>Ngounié</option>
                            <option value="Nyanga" @if(old('province')==='Nyanga' ) selected @endif>Nyanga</option>
                            <option value="Ogooué-Ivindo" @if(old('province')==='Ogooué-Ivindo' ) selected @endif>Ogooué-Ivindo</option>
                            <option value="Ogooué-Lolo" @if(old('province')==='Ogooué-Lolo' ) selected @endif>Ogooué-Lolo</option>
                            <option value="Ogooué-Maritime" @if(old('province')==='Ogooué-Maritime' ) selected @endif>Ogooué-Maritime</option>
                            <option value="Woleu-Ntem" @if(old('province')==='Woleu-Ntem' ) selected @endif>Woleu-Ntem</option>
                        </select>
                    </div>
                    @error('province')<div id="error-province" class="error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <div>
                    <label for="gender">Genre</label>
                    <div class="input-container select-wrapper @error('gender') error @enderror">
                        <i class="fas fa-venus-mars icon" aria-hidden="true"></i>
                        <select id="gender" name="gender" autocomplete="sex" aria-describedby="error-gender">
                            <option value="">— Sélectionner —</option>
                            <option value="male" @if(old('gender')==='male' ) selected @endif>Homme</option>
                            <option value="female" @if(old('gender')==='female' ) selected @endif>Femme</option>
                            <option value="other" @if(old('gender')==='other' ) selected @endif>Autre</option>
                            <option value="prefer_not" @if(old('gender')==='prefer_not' ) selected @endif>Préfère ne pas répondre</option>
                        </select>
                    </div>
                    @error('gender')<div id="error-gender" class="error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label for="phone_number">Téléphone</label>
                    <div class="input-container @error('phone_number') error @enderror">
                        <i class="fas fa-phone icon" aria-hidden="true"></i>
                        <input id="phone_number" name="phone_number" type="tel" pattern="^\+?\d{6,20}$" value="{{ old('phone_number') }}" placeholder="+241xxxxxxxxx" autocomplete="tel" aria-describedby="error-phone_number" />
                    </div>
                    <div class="small">Format recommandé : +241 (ou indicatif complet).</div>
                    @error('phone_number')<div id="error-phone_number" class="error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="full" style="margin-bottom: 1.75rem;">
                <label for="email">Email <span class="required">*</span></label>
                <div class="input-container @error('email') error @enderror">
                    <i class="fas fa-envelope icon" aria-hidden="true"></i>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required aria-required="true" autocomplete="email" placeholder="exemple@mail.com" aria-describedby="error-email" />
                </div>
                @error('email')<div id="error-email" class="error">{{ $message }}</div>@enderror
            </div>

            <div class="password-row">
                <div>
                    <label for="password">Mot de passe <span class="required">*</span></label>
                    <div class="input-container @error('password') error @enderror">
                        <i class="fas fa-lock icon" aria-hidden="true"></i>
                        <input id="password" name="password" type="password" required aria-required="true" minlength="8" autocomplete="new-password" aria-describedby="error-password" placeholder="8 caractères minimum" />
                        <button type="button" class="toggle-password" data-target="password" aria-label="Afficher ou masquer le mot de passe" tabindex="-1">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                    @error('password')<div id="error-password" class="error">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label for="password_confirmation">Confirmer le mot de passe <span class="required">*</span></label>
                    <div class="input-container">
                        <i class="fas fa-lock icon" aria-hidden="true"></i>
                        <input id="password_confirmation" name="password_confirmation" type="password" required aria-required="true" minlength="8" autocomplete="new-password" placeholder="Confirmez le mot de passe" />
                        <button type="button" class="toggle-password" data-target="password_confirmation" aria-label="Afficher ou masquer la confirmation du mot de passe" tabindex="-1">
                            <i class="fas fa-eye" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="full small" style="text-align: center;">
                En vous inscrivant, vous acceptez nos <a href="{{ route('terms') }}">conditions</a> et la <a href="{{ route('privacy') }}">politique de confidentialité</a>.
            </div>

            <div class="full" style="margin-top: 2rem;">
                <button type="submit">
                    <i class="fas fa-user-plus"></i> S'inscrire
                </button>
            </div>
        </form>
    </div>

    <script>
        // ----------------------------------------------------
        // FONCTIONNALITÉ VOIR/CACHER MOT DE PASSE (Améliorée)
        // ----------------------------------------------------
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', () => {
                const input = btn.previousElementSibling;
                const icon = btn.querySelector('i');

                if (!input || !icon) return;

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.className = 'fas fa-eye-slash'; // Icône pour Masquer
                    btn.setAttribute('aria-label', 'Masquer le mot de passe');
                } else {
                    input.type = 'password';
                    icon.className = 'fas fa-eye'; // Icône pour Afficher
                    btn.setAttribute('aria-label', 'Afficher le mot de passe');
                }
            });
        });

        // ----------------------------------------------------
        // LOGIQUE D'ERREUR CÔTÉ CLIENT (CSS/HTML5)
        // ----------------------------------------------------
        const form = document.querySelector('form');
        form.addEventListener('submit', e => {
            form.querySelectorAll('input, select').forEach(el => {
                const container = el.closest('.input-container');

                if (el.checkValidity() === false) {
                    // Ajoute la classe d'erreur au container pour la bordure inférieure
                    if (container) container.classList.add('error');
                    // Ajout d'une petite animation de secouage visuelle si vous le souhaitez
                    // container.classList.add('shake');
                } else {
                    // Retire la classe d'erreur
                    if (container) container.classList.remove('error');
                }
            });
        });

        // Retirer la classe d'erreur sur l'input
        form.querySelectorAll('input, select').forEach(el => {
            el.addEventListener('input', () => {
                const container = el.closest('.input-container');
                if (container && el.checkValidity()) {
                    container.classList.remove('error');
                }
            });
        });

    </script>
</body>
</html>
