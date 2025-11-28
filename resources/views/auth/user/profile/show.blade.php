<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Mon profil — GabonÉcho</title>
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f7fafc;
            padding: 2rem;
            color: #111;
        }

        .card {
            max-width: 700px;
            margin: 0 auto;
            background: #fff;
            padding: 2rem 2.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(16, 24, 40, 0.06);
        }

        h1 {
            margin-bottom: 2rem;
            font-weight: 700;
            color: #005a9c;
            text-align: center;
        }

        .profile-photo {
            display: block;
            margin: 0 auto 2rem;
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #0a9396;
            box-shadow: 0 4px 12px rgba(10, 147, 150, 0.3);
        }

        .profile-info {
            margin-bottom: 1rem;
        }

        .label {
            font-weight: 600;
            color: #1f2937;
        }

        .value {
            margin-top: 0.25rem;
            font-size: 1.1rem;
            color: #374151;
        }

        .color-box {
            display: inline-block;
            width: 20px;
            height: 20px;
            vertical-align: middle;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-left: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        .btn-edit {
            display: block;
            width: 260px;
            margin: 3rem auto 0;
            background: #0a9396;
            color: #fff;
            padding: 1rem;
            border-radius: 10px;
            border: none;
            text-align: center;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            text-decoration: none;
            box-shadow: 0 8px 20px rgba(10, 147, 150, 0.4);
            transition: background 0.3s ease;
        }

        .btn-edit:hover {
            background: #005f73;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>Mon profil</h1>

        <img
            src="{{ $user->profile_photo_url ?? asset('default-profile.png') }}"
            alt="Photo de profil"
            class="profile-photo"
            loading="lazy"
        />

        <div class="profile-info">
            <div class="label">Nom complet</div>
            <div class="value">{{ $user->name ?? 'Non renseigné' }}</div>
        </div>

        <div class="profile-info">
            <div class="label">Nom d'affichage</div>
            <div class="value">{{ $user->display_name ?? 'Non renseigné' }}</div>
        </div>

        <div class="profile-info">
            <div class="label">Date de naissance</div>
            <div class="value">{{ $user->birthdate ? $user->birthdate->format('d/m/Y') : 'Non renseigné' }}</div>
        </div>

        <div class="profile-info">
            <div class="label">Numéro de téléphone</div>
            <div class="value">{{ $user->phone ?? 'Non renseigné' }}</div>
        </div>

        <div class="profile-info">
            <div class="label">Email</div>
            <div class="value">{{ $user->email ?? 'Non renseigné' }}</div>
        </div>

        <div class="profile-info">
            <div class="label">Couleur des icônes</div>
            <div class="value">
                {{ $user->icon_color ?? 'Non renseigné' }}
                <span class="color-box" style="background-color: {{ $user->icon_color ?? '#ccc' }}"></span>
            </div>
        </div>

        <div class="profile-info">
            <div class="label">Couleur d'arrière-plan</div>
            <div class="value">
                {{ $user->background_color ?? 'Non renseigné' }}
                <span class="color-box" style="background-color: {{ $user->background_color ?? '#ccc' }}"></span>
            </div>
        </div>

        <a href="{{ route('profile.edit') }}" class="btn-edit">Modifier les paramètres du profil</a>
    </div>
</body>
</html>
