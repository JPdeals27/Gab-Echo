<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Contact — GabonÉcho</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 2rem;
            color: #1b1b18;
            background: #fff
        }

        .container {
            max-width: 900px;
            margin: 0 auto
        }

        label {
            display: block;
            margin-top: 1rem
        }

        input,
        textarea {
            width: 100%;
            padding: .5rem;
            border: 1px solid #ddd;
            border-radius: .35rem
        }

        button {
            margin-top: 1rem;
            padding: .5rem 1rem;
            background: #f53003;
            color: #fff;
            border: none;
            border-radius: .35rem
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Contact</h1>
        <p>Pour toute question ou suggestion, utilisez le formulaire ci-dessous ou contactez-nous via nos réseaux sociaux.</p>

        <form method="POST" action="{{ route('contact.send') }}">
            @csrf
            <label for="name">Nom</label>
            <input id="name" name="name" type="text" required />

            <label for="email">Email</label>
            <input id="email" name="email" type="email" required />

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="6" required></textarea>

            <button type="submit">Envoyer</button>
        </form>

        <section style="margin-top:1.5rem">
            <h2>Réseaux sociaux</h2>
            <p>Suivez-nous sur Twitter · Facebook · Instagram</p>
        </section>
    </div>
</body>
</html>
