<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Créer une proposition — GabonÉcho</title>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

    /* Reset léger */
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Inter', Arial, sans-serif;
        background: #f7f8fa;
        margin: 0; padding: 1.5rem;
        color: #1b1b18;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .container {
        max-width: 960px;
        margin: 0 auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.07);
        padding: 2rem 3rem;
        display: flex;
        gap: 3rem;
        flex-wrap: wrap;
    }

    h1 {
        font-weight: 700;
        font-size: 2.4rem;
        color: #c8102e;
        margin-bottom: 1.8rem;
        flex-basis: 100%;
        user-select: none;
        text-align: center;
        text-shadow: 1px 1px 3px rgba(200, 16, 46, 0.3);
    }

    form {
        flex: 1 1 500px;
        display: flex;
        flex-direction: column;
        gap: 1.2rem;
    }

    label {
        font-weight: 600;
        font-size: 1.05rem;
        margin-bottom: 0.4rem;
        cursor: pointer;
        color: #2b2b2b;
        user-select: none;
    }

    input[type=text],
    input[type=file],
    select,
    textarea,
    input[type=color] {
        padding: 0.65rem 1rem;
        font-size: 1rem;
        border-radius: 8px;
        border: 2px solid #ddd;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        font-family: inherit;
        resize: vertical;
        background: #fafafa;
        color: #222;
    }

    input[type=text]:focus,
    input[type=file]:focus,
    select:focus,
    textarea:focus,
    input[type=color]:focus {
        border-color: #c8102e;
        outline: none;
        box-shadow: 0 0 8px rgba(200, 16, 46, 0.45);
        background: #fff;
    }

    textarea {
        min-height: 120px;
        line-height: 1.5;
        font-family: 'Inter', Arial, sans-serif;
    }

    .row {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .col {
        flex: 1 1 250px;
        min-width: 220px;
        display: flex;
        flex-direction: column;
    }

    .checkbox-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 600;
        font-size: 1rem;
        user-select: none;
    }

    .btn-group {
        display: flex;
        gap: 1rem;
        margin-top: 1.6rem;
    }

    button, .btn {
        padding: 0.9rem 1.6rem;
        font-weight: 700;
        font-size: 1.15rem;
        border-radius: 10px;
        cursor: pointer;
        border: none;
        transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
        font-family: inherit;
        user-select: none;
        box-shadow: 0 8px 20px rgba(200, 16, 46, 0.3);
    }

    button.submit-btn {
        background: #c8102e;
        color: #fff;
        flex: 1;
    }

    button.submit-btn:hover,
    button.submit-btn:focus {
        background: #92001f;
        box-shadow: 0 12px 32px rgba(146, 0, 31, 0.5);
        transform: translateY(-2px);
        outline: none;
    }

    button.preview-btn {
        background: #444;
        color: #eee;
        flex-basis: 130px;
    }

    button.preview-btn:hover,
    button.preview-btn:focus {
        background: #222;
        box-shadow: 0 10px 25px rgba(34, 34, 34, 0.5);
        transform: translateY(-2px);
        outline: none;
    }

    a.btn-secondary {
        display: inline-block;
        margin-bottom: 1.5rem;
        padding: 0.6rem 1.2rem;
        background: #666;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.18);
        transition: background 0.3s ease;
        user-select: none;
        user-drag: none;
    }

    a.btn-secondary:hover,
    a.btn-secondary:focus {
        background: #333;
        outline: none;
    }

    .error-message {
        color: #d93025;
        font-size: 0.9rem;
        margin-top: 0.3rem;
        user-select: none;
    }

    /* Aperçu */
    .preview {
        flex: 1 1 380px;
        background: var(--preview-bg, #fff);
        border-radius: 14px;
        box-shadow: 0 14px 40px rgba(200, 16, 46, 0.15);
        padding: 2rem;
        display: flex;
        flex-direction: column;
        gap: 1.8rem;
        color: var(--icon-color, #c8102e);
        transition: background-color 0.5s ease, color 0.5s ease;
        user-select: none;
    }

    .preview h3 {
        font-weight: 700;
        font-size: 1.8rem;
        text-align: center;
        text-shadow: 1px 1px 3px rgba(200, 16, 46, 0.4);
        margin: 0;
    }

    .preview-content-wrapper {
        display: flex;
        gap: 1.5rem;
        align-items: flex-start;
    }

    .preview-image {
        width: 180px;
        height: 140px;
        object-fit: cover;
        border-radius: 12px;
        border: 2px solid #eee;
        box-shadow: 0 6px 18px rgba(200, 16, 46, 0.3);
        flex-shrink: 0;
        display: none;
    }

    .preview-text {
        flex: 1;
    }

    .preview-title {
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0 0 0.3rem 0;
        color: inherit;
        word-break: break-word;
    }

    .preview-meta {
        font-size: 0.9rem;
        color: #555;
        font-weight: 600;
        margin-bottom: 0.6rem;
    }

    .preview-content {
        font-size: 1.05rem;
        line-height: 1.5;
        color: #333;
        white-space: pre-wrap;
        word-wrap: break-word;
        max-height: 240px;
        overflow-y: auto;
        padding-right: 4px;
    }

    /* Couleurs dans l'aperçu */
    .color-sample {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        border: 2px solid #ccc;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        margin: 0 auto 0.4rem auto;
        transition: background-color 0.5s ease;
    }

    .color-label {
        text-align: center;
        font-weight: 600;
        color: #555;
        font-size: 0.9rem;
        user-select: none;
    }

    .color-wrapper {
        display: flex;
        justify-content: space-around;
        margin-top: 1.8rem;
        gap: 2rem;
    }

    /* Responsive */
    @media (max-width: 850px) {
        .container {
            flex-direction: column;
            padding: 1.5rem 1.5rem;
        }

        form, .preview {
            flex: 1 1 100%;
        }

        .preview-content-wrapper {
            flex-direction: column;
            align-items: center;
        }

        .preview-image {
            width: 220px;
            height: 160px;
        }
    }
</style>

<script>
    // Fonction de prévisualisation dynamique
    function previewProposal() {
        const title = document.getElementById('title').value.trim();
        const content = document.getElementById('content').value.trim();
        const region = document.getElementById('region').value || '—';
        const anon = document.getElementById('anonymous').checked;
        const imgInput = document.getElementById('image');
        const iconColorInput = document.getElementById('icon_color');
        const bgColorInput = document.getElementById('background_color');

        // Mise à jour du texte
        document.getElementById('preview-title').textContent = title || 'Titre de la proposition';
        document.getElementById('preview-content').textContent = content || 'Aperçu du contenu...';
        document.getElementById('preview-meta').textContent = (anon ? 'Par Anonyme' : 'Par vous') + ' · ' + region;

        // Image preview
        const previewImg = document.getElementById('preview-image');
        if (imgInput.files && imgInput.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.style.display = 'block';
                previewImg.alt = 'Image jointe à la proposition';
            }
            reader.readAsDataURL(imgInput.files[0]);
        } else {
            previewImg.style.display = 'none';
            previewImg.src = '';
            previewImg.alt = '';
        }

        // Couleurs personnalisées
        const previewSection = document.querySelector('.preview');
        const iconColorSample = document.getElementById('iconColorSample');
        const bgColorSample = document.getElementById('bgColorSample');

        const iconColor = iconColorInput.value || '#c8102e';
        const bgColor = bgColorInput.value || '#ffffff';

        previewSection.style.setProperty('--icon-color', iconColor);
        previewSection.style.setProperty('--preview-bg', bgColor);

        iconColorSample.style.backgroundColor = iconColor;
        bgColorSample.style.backgroundColor = bgColor;
    }

    // Initialisation et gestion des événements
    document.addEventListener('DOMContentLoaded', () => {
        // Champs à surveiller
        const fields = ['title', 'content', 'region', 'anonymous', 'image', 'icon_color', 'background_color'];

        fields.forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;
            const eventType = (el.tagName.toLowerCase() === 'input' && el.type === 'file') ? 'change' : 'input';
            el.addEventListener(eventType, previewProposal);
        });

        previewProposal(); // preview initiale
    });

    // Raccourcis clavier dans textarea
    function wrapSelection(wrapper) {
        const ta = document.getElementById('content');
        if (typeof ta.selectionStart === 'number' && typeof ta.selectionEnd === 'number') {
            const start = ta.selectionStart;
            const end = ta.selectionEnd;
            const selected = ta.value.slice(start, end);
            ta.value = ta.value.slice(0, start) + wrapper + selected + wrapper + ta.value.slice(end);
            ta.selectionStart = start + wrapper.length;
            ta.selectionEnd = end + wrapper.length;
            ta.focus();
            previewProposal();
        }
    }

    function initRichEditor() {
        const ta = document.getElementById('content');
        ta.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'b') {
                e.preventDefault();
                wrapSelection('**');
            }
            if (e.ctrlKey && e.key === 'i') {
                e.preventDefault();
                wrapSelection('*');
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        initRichEditor();
    });
</script>

</head>
<body>
<div class="container" role="main" aria-label="Formulaire de création de proposition">
    <h1>Créer une proposition</h1>

    <a href="{{ route('user.dashboard') }}" class="btn-secondary" aria-label="Retour à mon espace utilisateur">← Retour à mon espace</a>

    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data" novalidate>
        @csrf

        <!-- Titre -->
        <label for="title">Titre</label>
        <input id="title" name="title" type="text" value="{{ old('title') }}" required aria-required="true" placeholder="Ex : Améliorer la sécurité routière">
        @error('title')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <!-- Contenu -->
        <label for="content">Contenu (éditeur riche simple — Ctrl+B / Ctrl+I)</label>
        <textarea id="content" name="content" rows="8" required aria-required="true" placeholder="Décrivez votre proposition ici...">{{ old('content') }}</textarea>
        @error('content')
            <div class="error-message">{{ $message }}</div>
        @enderror

        <div class="row">
            <div class="col">
                <!-- Image -->
                <label for="image">Image (facultative)</label>
                <input id="image" name="image" type="file" accept="image/*" aria-describedby="imageHelp">
                @error('image')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <!-- Couleur icônes -->
                <label for="icon_color" style="margin-top: 1.4rem;">Couleur des icônes / textes importants</label>
                <input id="icon_color" name="icon_color" type="color" value="{{ old('icon_color', '#c8102e') }}" aria-label="Sélecteur de couleur pour icônes et textes importants">
                @error('icon_color')
                    <div class="error-message">{{ $message }}</div>
                @enderror

                <!-- Couleur arrière-plan -->
                <label for="background_color" style="margin-top: 1.4rem;">Couleur d'arrière-plan</label>
                <input id="background_color" name="background_color" type="color" value="{{ old('background_color', '#ffffff') }}" aria-label="Sélecteur de couleur d'arrière-plan">
                @error('background_color')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="col">
                <!-- Catégorie -->
                <label for="category">Catégorie</label>
                <select id="category" name="category" aria-label="Sélectionnez une catégorie">
                    <option value="">-- Sélectionner --</option>
                    <option value="Technologie" {{ old('category') == 'Technologie' ? 'selected' : '' }}>Technologie</option>
                    <option value="Société" {{ old('category') == 'Société' ? 'selected' : '' }}>Société</option>
                    <option value="Sécurité" {{ old('category') == 'Sécurité' ? 'selected' : '' }}>Sécurité</option>
                    <option value="Politique" {{ old('category') == 'Politique' ? 'selected' : '' }}>Politique</option>
                    <option value="Culture" {{ old('category') == 'Culture' ? 'selected' : '' }}>Culture</option>
                    <option value="Économie" {{ old('category') == 'Économie' ? 'selected' : '' }}>Économie</option>
                </select>

                <!-- Région -->
                <label for="region" style="margin-top: 1.2rem;">Région</label>
                <select id="region" name="region" aria-label="Sélectionnez une région">
                    <option value="">-- Sélectionner --</option>
                    <option value="Est" {{ old('region') == 'Est' ? 'selected' : '' }}>Est</option>
                    <option value="Ouest" {{ old('region') == 'Ouest' ? 'selected' : '' }}>Ouest</option>
                    <option value="Nord" {{ old('region') == 'Nord' ? 'selected' : '' }}>Nord</option>
                    <option value="Sud" {{ old('region') == 'Sud' ? 'selected' : '' }}>Sud</option>
                    <option value="Centre" {{ old('region') == 'Centre' ? 'selected' : '' }}>Centre</option>
                </select>

                <!-- Anonyme -->
                <label class="checkbox-label" for="anonymous" style="margin-top: 1.4rem;">
                    <input id="anonymous" name="anonymous" type="checkbox" value="1" {{ old('anonymous') ? 'checked' : '' }}>
                    Publier anonymement
                </label>
            </div>
        </div>

        <div class="btn-group" role="group" aria-label="Actions formulaire">
            <button type="submit" class="submit-btn" aria-label="Soumettre la proposition">Publier</button>
            <button type="button" class="preview-btn" onclick="previewProposal()" aria-label="Mettre à jour l'aperçu">Aperçu</button>
        </div>
    </form>

    <section aria-live="polite" aria-atomic="true" class="preview" role="region" aria-label="Aperçu de la proposition">
        <h3 id="preview-title">Titre de la proposition</h3>
        <div class="preview-content-wrapper">
            <img id="preview-image" class="preview-image" alt="" src="" aria-hidden="true" />
            <div class="preview-text">
                <p class="preview-meta" id="preview-meta">Par vous · —</p>
                <p class="preview-content" id="preview-content">Aperçu du contenu...</p>
            </div>
        </div>

        <div class="color-wrapper" aria-label="Couleurs sélectionnées">
            <div>
                <div class="color-sample" id="iconColorSample" aria-label="Couleur icônes"></div>
                <p class="color-label">Couleur icônes</p>
            </div>
            <div>
                <div class="color-sample" id="bgColorSample" aria-label="Couleur arrière-plan"></div>
                <p class="color-label">Couleur arrière-plan</p>
            </div>
        </div>
    </section>
</div>
</body>
</html>
