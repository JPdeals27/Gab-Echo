<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Modifier mon profil — GabonÉcho</title>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

    /* Reset et base */
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', Arial, sans-serif;
        background: #f0f4f8;
        margin: 0;
        padding: 2rem;
        color: #222;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .container {
        max-width: 900px;
        margin: 0 auto;
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 16px 48px rgba(0, 0, 0, 0.08);
        padding: 2.5rem 3rem;
        display: flex;
        gap: 3rem;
        flex-wrap: wrap;
    }

    /* Colonne Form */
    .form-section {
        flex: 1 1 400px;
        min-width: 320px;
    }

    h1 {
        font-weight: 700;
        font-size: 2.5rem;
        color: #005a9c;
        margin-bottom: 2rem;
        text-align: center;
        user-select: none;
    }

    label {
        display: block;
        font-weight: 600;
        color: #1f2937;
        margin-top: 1.3rem;
        margin-bottom: 0.5rem;
        cursor: pointer;
        font-size: 1.05rem;
        transition: color 0.3s ease;
    }

    label:hover {
        color: #0a9396;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"],
    input[type="tel"],
    input[type="password"],
    input[type="color"],
    input[type="file"] {
        width: 100%;
        padding: 0.75rem 1.1rem;
        font-size: 1rem;
        border: 2px solid #d1d9e6;
        border-radius: 10px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        font-family: inherit;
        background: #fefefe;
        color: #111;
        user-select: text;
    }

    input[type="file"] {
        padding: 0.4rem 1rem;
    }

    input:focus {
        border-color: #0a9396;
        outline: none;
        box-shadow: 0 0 8px rgba(10, 147, 150, 0.45);
        background: #fff;
    }

    button {
        margin-top: 2.5rem;
        background: #0a9396;
        color: #fff;
        padding: 1.3rem;
        border-radius: 12px;
        border: none;
        font-weight: 700;
        font-size: 1.3rem;
        cursor: pointer;
        width: 100%;
        box-shadow: 0 12px 32px rgba(10, 147, 150, 0.45);
        transition: background 0.35s ease, transform 0.15s ease;
        font-family: inherit;
        user-select: none;
    }

    button:hover,
    button:focus {
        background: #005f73;
        outline: none;
        transform: translateY(-2px);
        box-shadow: 0 18px 44px rgba(0, 95, 115, 0.6);
    }

    .error {
        color: #e11d48;
        font-size: 0.9rem;
        margin-top: 0.25rem;
        user-select: none;
    }

    .success {
        color: #0f5132;
        background: #d1e7dd;
        padding: 0.9rem 1.2rem;
        border-radius: 10px;
        margin-bottom: 1.7rem;
        text-align: center;
        font-weight: 700;
        user-select: none;
        box-shadow: 0 4px 12px rgba(13, 110, 33, 0.3);
    }

    /* Preview section */
    .preview-section {
        flex: 1 1 350px;
        min-width: 300px;
        background: #e0f7f7;
        border-radius: 16px;
        padding: 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        box-shadow: 0 10px 30px rgba(10, 147, 150, 0.15);
        user-select: none;
    }

    .preview-photo {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        object-fit: cover;
        border: 5px solid #0a9396;
        box-shadow: 0 6px 18px rgba(10, 147, 150, 0.5);
        margin-bottom: 2rem;
        transition: border-color 0.4s ease;
    }

    .preview-name {
        font-size: 1.9rem;
        font-weight: 700;
        margin-bottom: 1rem;
        color: #004e6b;
        text-align: center;
    }

    .preview-info {
        font-size: 1.1rem;
        color: #055e6b;
        margin-bottom: 1.8rem;
        text-align: center;
        max-width: 280px;
        line-height: 1.5;
    }

    .color-preview-group {
        width: 100%;
        display: flex;
        justify-content: space-around;
        gap: 1rem;
    }

    .color-box {
        flex: 1 1 120px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(10, 147, 150, 0.25);
        padding: 1.2rem 1.5rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: box-shadow 0.3s ease;
    }

    .color-box:hover {
        box-shadow: 0 8px 30px rgba(10, 147, 150, 0.45);
    }

    .color-box h3 {
        margin: 0 0 1rem 0;
        font-weight: 600;
        color: #007b9f;
        font-size: 1.2rem;
        user-select: text;
    }

    .color-sample {
        width: 70px;
        height: 70px;
        border-radius: 14px;
        border: 2.5px solid #ccc;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        margin-bottom: 0.6rem;
        transition: border-color 0.4s ease, box-shadow 0.4s ease;
    }

    .color-code {
        font-family: monospace;
        font-weight: 700;
        font-size: 1rem;
        color: #1d3557;
        user-select: text;
    }

    /* Responsive */
    @media (max-width: 720px) {
        .container {
            flex-direction: column;
            padding: 1.5rem 1.5rem;
        }

        .form-section, .preview-section {
            min-width: 100%;
        }
    }
</style>
</head>
<body>
    <div class="container" role="main" aria-label="Formulaire de modification du profil utilisateur">
        <section class="form-section">
            <h1>Modifier mon profil</h1>

            @if(session('success'))
                <div class="success" role="alert" aria-live="polite">{{ session('success') }}</div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <!-- Photo de profil -->
                <label for="profile_photo_path">Photo de profil</label>
                <input
                    type="file"
                    id="profile_photo_path"
                    name="profile_photo_path"
                    accept="image/*"
                    onchange="previewPhoto(event)"
                    aria-describedby="profile_photo_help"
                />
                @error('profile_photo_path')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Prénom -->
                <label for="first_name">Prénom <span aria-hidden="true">*</span></label>
                <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    value="{{ old('first_name', $user->first_name ?? '') }}"
                    required
                    aria-required="true"
                />
                @error('first_name')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Nom -->
                <label for="last_name">Nom <span aria-hidden="true">*</span></label>
                <input
                    type="text"
                    id="last_name"
                    name="last_name"
                    value="{{ old('last_name', $user->last_name ?? '') }}"
                    required
                    aria-required="true"
                />
                @error('last_name')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Date de naissance -->
                <label for="date_of_birth">Date de naissance</label>
                <input
                    type="date"
                    id="date_of_birth"
                    name="date_of_birth"
                    value="{{ old('date_of_birth', optional($user->date_of_birth)->format('Y-m-d')) }}"
                />
                @error('date_of_birth')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Numéro de téléphone -->
                <label for="phone_number">Numéro de téléphone</label>
                <input
                    type="tel"
                    id="phone_number"
                    name="phone_number"
                    value="{{ old('phone_number', $user->phone_number ?? '') }}"
                    pattern="[\d\s+()-]{6,20}"
                    placeholder="+241 06 00 00 00"
                />
                @error('phone_number')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Email -->
                <label for="email">Email <span aria-hidden="true">*</span></label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email', $user->email ?? '') }}"
                    required
                    aria-required="true"
                />
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Nouveau mot de passe -->
                <label for="password">Nouveau mot de passe (laisser vide pour conserver)</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    autocomplete="new-password"
                />
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Confirmation mot de passe -->
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    autocomplete="new-password"
                />

                <!-- Couleur des icônes -->
                <label for="icon_color">Couleur des icônes</label>
                <input
                    type="color"
                    id="icon_color"
                    name="icon_color"
                    value="{{ old('icon_color', $user->icon_color ?? '#0a9396') }}"
                    aria-label="Couleur des icônes"
                    onchange="updateIconColor(this.value)"
                />
                @error('icon_color')
                    <div class="error">{{ $message }}</div>
                @enderror

                <!-- Couleur d'arrière-plan -->
                <label for="background_color">Couleur d'arrière-plan</label>
                <input
                    type="color"
                    id="background_color"
                    name="background_color"
                    value="{{ old('background_color', $user->background_color ?? '#e0f7f7') }}"
                    aria-label="Couleur d'arrière-plan"
                    onchange="updateBackgroundColor(this.value)"
                />
                @error('background_color')
                    <div class="error">{{ $message }}</div>
                @enderror

                <button type="submit" aria-label="Enregistrer les modifications du profil">
                    Enregistrer les modifications
                </button>
            </form>
        </section>

        <!-- Preview dynamique -->
        <aside class="preview-section" aria-label="Aperçu du profil">
            <img
                src="{{ asset($user->profile_photo_path ?? 'default-avatar.png') }}"
                alt="Photo de profil"
                id="photoPreview"
                class="preview-photo"
                loading="lazy"
                aria-live="polite"
            />
            <div class="preview-name" id="previewName">
                {{ $user->first_name }} {{ $user->last_name }}
            </div>
            <div class="preview-info" id="previewEmail">
                {{ $user->email }}
            </div>

            <div class="color-preview-group" aria-live="polite" aria-atomic="true">
                <div class="color-box" aria-label="Couleur d'arrière-plan actuelle">
                    <h3>Arrière-plan</h3>
                    <div id="bgColorSample" class="color-sample"></div>
                    <div id="bgColorCode" class="color-code"></div>
                </div>

                <div class="color-box" aria-label="Couleur des icônes actuelle">
                    <h3>Icônes</h3>
                    <div id="iconColorSample" class="color-sample"></div>
                    <div id="iconColorCode" class="color-code"></div>
                </div>
            </div>
        </aside>
    </div>

<script>
    // Preview photo dynamique
    function previewPhoto(event) {
        const input = event.target;
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('photoPreview');
                img.src = e.target.result;
                img.alt = 'Prévisualisation de la nouvelle photo de profil';
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Mise à jour couleurs preview
    function updateBackgroundColor(color) {
        const bgSample = document.getElementById('bgColorSample');
        const bgCode = document.getElementById('bgColorCode');
        const previewSection = document.querySelector('.preview-section');

        bgSample.style.backgroundColor = color;
        bgCode.textContent = color.toUpperCase();

        previewSection.style.backgroundColor = color;
    }

    function updateIconColor(color) {
        const iconSample = document.getElementById('iconColorSample');
        const iconCode = document.getElementById('iconColorCode');
        const previewName = document.getElementById('previewName');
        const previewEmail = document.getElementById('previewEmail');

        iconSample.style.backgroundColor = color;
        iconCode.textContent = color.toUpperCase();

        // Appliquer la couleur des icônes sur le texte de l'aperçu
        previewName.style.color = color;
        previewEmail.style.color = color;
    }

    // Initialiser les couleurs preview au chargement
    document.addEventListener('DOMContentLoaded', () => {
        updateBackgroundColor(document.getElementById('background_color').value);
        updateIconColor(document.getElementById('icon_color').value);
    });
</script>

</body>
</html>
