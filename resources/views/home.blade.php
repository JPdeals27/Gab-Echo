<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GabonÉcho — Le blog citoyen</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-xxxxxx" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Reset CSS basique */
        *, *::before, *::after {
            box-sizing: border-box;
        }
        body, h1, h2, h3, h4, h5, h6, p, figure, blockquote, dl, dd {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #222;
            background-color: #fefefe;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        a:hover,
        a:focus {
            color: #0056b3;
            outline: none;
            text-decoration: underline;
        }
        .container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* HEADER */
        header.site-nav {
            background-color: #004d40;
            color: #fff;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .brand .logo {
            font-weight: 900;
            font-size: 1.5rem;
            color: #a5d6a7;
            letter-spacing: 0.05em;
        }
        .brand .muted {
            color: #c8e6c9;
            font-weight: 300;
        }
        form.search-form {
            flex-grow: 1;
            max-width: 400px;
            margin-left: 2rem;
        }
        form.search-form input[type="search"] {
            width: 100%;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            border: none;
            font-size: 1rem;
            outline-offset: 2px;
            transition: box-shadow 0.3s ease;
        }
        form.search-form input[type="search"]:focus {
            box-shadow: 0 0 0 3px #a5d6a7;
            outline: none;
        }

        nav.main-nav a {
            color: #a5d6a7;
            font-weight: 600;
            margin-left: 1.5rem;
            position: relative;
            padding: 0.5rem 0;
        }
        nav.main-nav a:hover,
        nav.main-nav a:focus {
            color: #c8e6c9;
        }
        nav.main-nav a.cta {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            background-color: #a5d6a7;
            color: #004d40;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }
        nav.main-nav a.cta:hover,
        nav.main-nav a.cta:focus {
            background-color: #81c784;
            color: #00251a;
            outline: none;
        }
        nav.main-nav a.cta-primary.pulse {
            animation: pulse 2.5s infinite;
        }
        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(165, 214, 167, 0.7);
            }
            50% {
                box-shadow: 0 0 10px 8px rgba(165, 214, 167, 0);
            }
        }

        /* SECTION HERO */
        section.hero {
            background-color: #e8f5e9;
            padding: 3rem 0;
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            align-items: center;
        }
        section.hero .container.copy {
            flex: 1 1 500px;
        }
        .eyebrow {
            font-weight: 700;
            color: #388e3c;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }
        section.hero h1 {
            font-size: 2.5rem;
            font-weight: 900;
            color: #2e7d32;
            margin-bottom: 1rem;
        }
        section.hero p.lead {
            font-size: 1.125rem;
            font-weight: 400;
            margin-bottom: 1rem;
            color: #4caf50;
        }
        section.hero p a.cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            text-decoration: none;
            border-radius: 30px;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
        }
        section.hero p a.cta-primary {
            background-color: #388e3c;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        section.hero p a.cta-primary:hover,
        section.hero p a.cta-primary:focus {
            background-color: #2e7d32;
        }
        section.hero p a.cta-secondary {
            background-color: #a5d6a7;
            color: #004d40;
        }
        section.hero p a.cta-secondary:hover,
        section.hero p a.cta-secondary:focus {
            background-color: #81c784;
            color: #00251a;
        }

        section.hero .visual {
            flex: 1 1 600px;
            position: relative;
        }
        .carousel {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .carousel-item {
            opacity: 0;
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            transition: opacity 0.8s ease;
            pointer-events: none;
        }
        .carousel-item.active-slide {
            opacity: 1;
            position: relative;
            pointer-events: auto;
        }
        .carousel-item img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 1rem;
            object-fit: cover;
        }
        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        .carousel-dots button.dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: none;
            background-color: #a5d6a7;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .carousel-dots button.dot:hover,
        .carousel-dots button.dot:focus {
            background-color: #388e3c;
            outline: none;
        }
        .carousel-dots button.dot.active-dot {
            background-color: #2e7d32;
        }

        /* ARTICLES SECTION */
        section.articles-section {
            background-color: #fafafa;
            padding: 4rem 0;
        }
        .section-title {
            font-weight: 900;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #2e7d32;
        }
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }
        .article-card {
            background-color: white;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }
        .article-card:hover,
        .article-card:focus-within {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        .article-link {
            color: inherit;
            text-decoration: none;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .image-placeholder {
            width: 100%;
            padding-top: 56.25%; /* 16:9 ratio */
            background-size: cover;
            background-position: center center;
            border-bottom: 4px solid #a5d6a7;
            border-radius: 1rem 1rem 0 0;
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0.75rem 1rem 0 1rem;
            user-select: none;
        }
        .badge-Technologie {
            background-color: #388e3c;
            color: #e8f5e9;
        }
        .badge-Sécurité {
            background-color: #d32f2f;
            color: #ffebee;
        }
        .badge-ViePublique {
            background-color: #1976d2;
            color: #e3f2fd;
        }
        .badge-Citoyenneté {
            background-color: #fbc02d;
            color: #fffde7;
        }
        h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0.5rem 1rem 0 1rem;
            color: #004d40;
        }
        .article-card p {
            margin: 0.5rem 1rem 1rem 1rem;
            color: #444;
            flex-grow: 1;
        }
        .metadata {
            font-size: 0.875rem;
            font-weight: 400;
            color: #666;
            margin: 0 1rem 1rem 1rem;
            display: flex;
            justify-content: space-between;
            user-select: none;
        }

        /* ARTICLE ACTIONS */
        .article-actions {
            padding: 0.5rem 1rem 1rem 1rem;
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: flex-start;
        }
        .btn-action {
            background-color: #a5d6a7;
            border: none;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            cursor: pointer;
            color: #004d40;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            transition: background-color 0.3s ease;
            user-select: none;
        }
        .btn-action:hover,
        .btn-action:focus {
            background-color: #81c784;
            outline: none;
            color: #00251a;
        }
        .btn-action i {
            font-size: 1rem;
        }
        .like-btn {
            background-color: #d32f2f;
            color: #fff;
        }
        .like-btn:hover,
        .like-btn:focus {
            background-color: #b71c1c;
            color: #fff;
        }
        .comment-btn {
            background-color: #1976d2;
            color: #fff;
        }
        .comment-btn:hover,
        .comment-btn:focus {
            background-color: #0d47a1;
            color: #fff;
        }
        .btn-edit {
            background-color: #388e3c;
            color: #fff;
        }
        .btn-edit:hover,
        .btn-edit:focus {
            background-color: #2e7d32;
        }
        .btn-delete {
            background-color: #f44336;
            color: #fff;
        }
        .btn-delete:hover,
        .btn-delete:focus {
            background-color: #c62828;
        }

        /* COMMENTS SECTION */
        .comments-section {
            padding: 1rem;
            background-color: #f1f8e9;
            border-radius: 0 0 1rem 1rem;
            margin-top: 0.5rem;
            max-height: 300px;
            overflow-y: auto;
        }
        .comment {
            border-bottom: 1px solid #c8e6c9;
            padding: 0.5rem 0;
        }
        .comment:last-child {
            border-bottom: none;
        }
        .comment strong {
            color: #2e7d32;
            font-weight: 700;
        }
        .comment-date {
            font-size: 0.75rem;
            color: #777;
            margin-left: 0.5rem;
            user-select: none;
        }
        .comment p {
            margin-top: 0.25rem;
            font-size: 1rem;
            color: #333;
        }
        form.add-comment-form {
            margin-top: 1rem;
            display: flex;
            gap: 0.5rem;
        }
        .comment-input {
            flex-grow: 1;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            border: 1px solid #a5d6a7;
            font-size: 1rem;
            outline-offset: 2px;
            transition: border-color 0.3s ease;
        }
        .comment-input:focus {
            border-color: #388e3c;
            outline: none;
        }
        .btn-submit-comment {
            background-color: #388e3c;
            color: white;
            border: none;
            border-radius: 20px;
            padding: 0 1.5rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s ease;
            user-select: none;
        }
        .btn-submit-comment:hover,
        .btn-submit-comment:focus {
            background-color: #2e7d32;
            outline: none;
        }

        /* CALL TO ACTION */
        section.call-to-action {
            background-color: #388e3c;
            color: white;
            padding: 3rem 0;
            text-align: center;
            margin-top: 3rem;
        }
        section.call-to-action h2 {
            font-weight: 900;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        section.call-to-action p.lead {
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }
        section.call-to-action a.cta-primary {
            background-color: #a5d6a7;
            color: #004d40;
            font-weight: 700;
            padding: 0.75rem 2rem;
            border-radius: 30px;
            transition: background-color 0.3s ease;
            display: inline-block;
            text-decoration: none;
        }
        section.call-to-action a.cta-primary:hover,
        section.call-to-action a.cta-primary:focus {
            background-color: #81c784;
            color: #00251a;
            outline: none;
        }

        /* FOOTER */
        footer {
            background-color: #004d40;
            color: #a5d6a7;
            padding: 3rem 0 1rem 0;
            font-size: 0.9rem;
            margin-top: auto;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        .footer-brand .logo {
            font-weight: 900;
            font-size: 1.5rem;
            color: #c8e6c9;
            letter-spacing: 0.05em;
        }
        .footer-brand .muted {
            font-weight: 300;
            margin-top: 0.25rem;
            color: #81c784;
        }
        .footer-brand p {
            margin-top: 1rem;
            line-height: 1.4;
        }
        footer nav h4 {
            margin-bottom: 0.75rem;
            font-weight: 700;
            color: #a5d6a7;
        }
        footer nav a {
            display: block;
            color: #a5d6a7;
            margin-bottom: 0.5rem;
            font-weight: 400;
        }
        footer nav a:hover,
        footer nav a:focus {
            color: #c8e6c9;
            outline: none;
            text-decoration: underline;
        }
        .footer-bottom {
            margin-top: 2rem;
            border-top: 1px solid #2e7d32;
            padding-top: 1rem;
            text-align: center;
        }
        .footer-bottom a {
            color: #81c784;
            text-decoration: none;
        }
        .footer-bottom a:hover,
        .footer-bottom a:focus {
            color: #c8e6c9;
            text-decoration: underline;
            outline: none;
        }

        /* REVEAL ANIMATION */
        .reveal {
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.6s ease, transform 0.6s ease;
            will-change: opacity, transform;
        }
        .reveal.active {
            opacity: 1;
            transform: none;
        }

        /* Boutons Edit & Delete spécifiques */
        .editBtn {
            background-color: #388e3c;
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: background-color 0.3s ease;
        }
        .editBtn:hover,
        .editBtn:focus {
            background-color: #2e7d32;
            outline: none;
        }

        .deleteBtn {
            background-color: #f44336;
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            transition: background-color 0.3s ease;
        }
        .deleteBtn:hover,
        .deleteBtn:focus {
            background-color: #c62828;
            outline: none;
        }

    </style>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>GabonÉcho — Le blog citoyen</title>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet" />

    <!-- FontAwesome avec removal de l'integrity si incorrect, sinon remplacer par la vraie valeur -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* Reset CSS basique */
        *, *::before, *::after {
            box-sizing: border-box;
        }
        body, h1, h2, h3, h4, h5, h6, p, figure, blockquote, dl, dd {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            line-height: 1.5;
            color: #222;
            background-color: #fefefe;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        a:hover,
        a:focus {
            color: #0056b3;
            outline: none;
            text-decoration: underline;
        }
        .container {
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* HEADER */
        header.site-nav {
            background-color: #004d40;
            color: #fff;
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .nav-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .brand .logo {
            font-weight: 900;
            font-size: 1.5rem;
            color: #a5d6a7;
            letter-spacing: 0.05em;
        }
        .brand .muted {
            color: #c8e6c9;
            font-weight: 300;
        }
        form.search-form {
            flex-grow: 1;
            max-width: 400px;
            margin-left: 2rem;
        }
        form.search-form input[type="search"] {
            width: 100%;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            border: none;
            font-size: 1rem;
            outline-offset: 2px;
            transition: box-shadow 0.3s ease;
        }
        form.search-form input[type="search"]:focus {
            box-shadow: 0 0 0 3px #a5d6a7;
            outline: none;
        }

        nav.main-nav a {
            color: #a5d6a7;
            font-weight: 600;
            margin-left: 1.5rem;
            position: relative;
            padding: 0.5rem 0;
        }
        nav.main-nav a:hover,
        nav.main-nav a:focus {
            color: #c8e6c9;
        }
        nav.main-nav a.cta {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            background-color: #a5d6a7;
            color: #004d40;
            font-weight: 700;
            transition: background-color 0.3s ease;
        }
        nav.main-nav a.cta:hover,
        nav.main-nav a.cta:focus {
            background-color: #81c784;
            color: #00251a;
            outline: none;
        }
        nav.main-nav a.cta-primary.pulse {
            animation: pulse 2.5s infinite;
        }
        @keyframes pulse {
            0%, 100% {
                box-shadow: 0 0 0 0 rgba(165, 214, 167, 0.7);
            }
            50% {
                box-shadow: 0 0 10px 8px rgba(165, 214, 167, 0);
            }
        }

        /* SECTION HERO */
        section.hero {
            background-color: #e8f5e9;
            padding: 3rem 0;
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            align-items: center;
        }
        section.hero .container.copy {
            flex: 1 1 500px;
        }
        .eyebrow {
            font-weight: 700;
            color: #388e3c;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }
        section.hero h1 {
            font-size: 2.5rem;
            font-weight: 900;
            color: #2e7d32;
            margin-bottom: 1rem;
        }
        section.hero p.lead {
            font-size: 1.125rem;
            font-weight: 400;
            margin-bottom: 1rem;
            color: #4caf50;
        }
        /* Déplacer style inline dans CSS */
        section.hero p.cta-links {
            margin-top: 1.5rem;
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        section.hero p a.cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 700;
            text-decoration: none;
            border-radius: 30px;
            padding: 0.75rem 1.5rem;
            cursor: pointer;
        }
        section.hero p a.cta-primary {
            background-color: #388e3c;
            color: #fff;
            transition: background-color 0.3s ease;
        }
        section.hero p a.cta-primary:hover,
        section.hero p a.cta-primary:focus {
            background-color: #2e7d32;
        }
        section.hero p a.cta-secondary {
            background-color: #a5d6a7;
            color: #004d40;
        }
        section.hero p a.cta-secondary:hover,
        section.hero p a.cta-secondary:focus {
            background-color: #81c784;
            color: #00251a;
        }

        section.hero .visual {
            flex: 1 1 600px;
            position: relative;
        }
        .carousel {
            position: relative;
            overflow: hidden;
            border-radius: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .carousel-item {
            opacity: 0;
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            transition: opacity 0.8s ease;
            pointer-events: none;
        }
        .carousel-item.active-slide {
            opacity: 1;
            position: relative;
            pointer-events: auto;
        }
        .carousel-item img {
            width: 100%;
            height: auto;
            display: block;
            border-radius: 1rem;
            object-fit: cover;
        }
        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        .carousel-dots button.dot {
            width: 14px;
            height: 14px;
            border-radius: 50%;
            border: none;
            background-color: #a5d6a7;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .carousel-dots button.dot:hover,
        .carousel-dots button.dot:focus {
            background-color: #388e3c;
            outline: none;
        }
        .carousel-dots button.dot.active-dot {
            background-color: #2e7d32;
        }

        /* ARTICLES SECTION */
        section.articles-section {
            background-color: #fafafa;
            padding: 4rem 0;
        }
        .section-title {
            font-weight: 900;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #2e7d32;
        }
        .articles-grid {
            display: grid;
            margin-right: 10px;
            height: auto;
            width:  10PX;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 3rem;
        }
        .article-card {
            background-color: white;
            width: 600px;
            height: 100%;
            padding-top: auto; /* 16:9 ratio */
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease;
        }
        .article-card:hover,
        .article-card:focus-within {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        .article-link {
            color: inherit;
            text-decoration: none;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .image-placeholder {
            width: 600px;
            height: auto;
            padding-top: 750px; /* 16:9 ratio */
            background-size: cover;
            background-position: center center;
            border-bottom: 4px solid #a5d6a7;
            border-radius: 1rem 1rem 0 0;
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            margin: 0.75rem 1rem 0 1rem;
            user-select: none;
        }
        .badge-Technologie {
            background-color: #388e3c;
            color: #e8f5e9;
        }
        .badge-Sécurité {
            background-color: #d32f2f;
            color: #ffebee;
        }
        .badge-ViePublique {
            background-color: #1976d2;
            color: #e3f2fd;
        }
        .badge-Citoyenneté {
            background-color: #fbc02d;
            color: #fffde7;
        }
        h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0.5rem 1rem 0 1rem;
            color: #004d40;
        }
        .article-card p {
            margin: 0.5rem 1rem 1rem 1rem;
            color: #444;
            flex-grow: 1;
        }
        .metadata {
            font-size: 0.875rem;
            font-weight: 400;
            color: #666;
            margin: 0 1rem 1rem 1rem;
            display: flex;
            justify-content: space-between;
            user-select: none;
        }

        /* ARTICLE ACTIONS */
        .article-actions {
            padding: 0.5rem 1rem 1rem 1rem;
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: flex-start;
        }
        .btn-action {
            background-color: #a5d6a7;
            border: none;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            font-weight: 600;
            cursor: pointer;
            color: #004d40;
            display: flex;
            align-items: center;
            gap: 0.4rem;
            transition: background-color 0.3s ease;
            user-select: none;
        }
        .btn-action:hover,
        .btn-action:focus {
            background-color: #81c784;
            outline: none;
            color: #00251a;
        }
        .btn-action i {
            font-size: 1rem;
        }
        .like-btn {
            background-color: #d32f2f;
            color: #fff;
        }
        .like-btn:hover,
        .like-btn:focus {
            background-color: #b71c1c;
            color: #fff;
        }
        .comment-btn {
            background-color: #1976d2;
            color: #fff;
        }
        .comment-btn:hover,
        .comment-btn:focus {
            background-color: #0d47a1;
            color: #fff;
        }
        .btn-edit {
            background-color: #388e3c;
            color: #fff;
        }
        .btn-edit:hover,
        .btn-edit:focus {
            background-color: #2e7d32;
        }
        .btn-delete {
            background-color: #f44336;
            color: #fff;
        }
        .btn-delete:hover,
        .btn-delete:focus {
            background-color: #c62828;
        }

        /* COMMENTS SECTION */
        .comments-section {
            padding: 1rem;
            background-color: #f1f8e9;
            border-radius: 0 0 1rem 1rem;
            margin-top: 0.5rem;
            max-height: 300px;
            overflow-y: auto;
        }
        .comment {
            border-bottom: 1px solid #c8e6c9;
            padding: 0.5rem 0;
        }
        .comment:last-child {
            border-bottom: none;
        }
        .comment strong {
            color: #2e7d32;
            font-weight: 700;
        }
        .comment-date {
            font-size: 0.75rem;
            color: #777;
            margin-left: 0.5rem;
            user-select: none;
        }
        .comment p {
            margin-top: 0.25rem;
            font-size: 1rem;
            color: #333;
        }
        form.add-comment-form {
            margin-top: 1rem;
            display: flex;
            gap: 0.5rem;
        }
        .comment-input {
            flex-grow: 1;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            border: 1px solid #a5d6a7;
            font-size: 1rem;
            outline-offset: 2px;
        }
        .comment-input:focus {
            border-color: #388e3c;
            outline: none;
        }
        .btn-submit-comment {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            border: none;
            background-color: #388e3c;
            color: white;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-submit-comment:hover,
        .btn-submit-comment:focus {
            background-color: #2e7d32;
            outline: none;
        }

        /* CALL TO ACTION */
        section.call-to-action {
            background-color: #c8e6c9;
            padding: 3rem 0;
            text-align: center;
            color: #1b5e20;
        }
        section.call-to-action h2 {
            font-weight: 900;
            font-size: 2rem;
            margin-bottom: 1rem;
        }
        section.call-to-action p.lead {
            font-weight: 600;
            font-size: 1.25rem;
            margin-bottom: 2rem;
        }
        section.call-to-action a.cta-primary {
            padding: 1rem 2rem;
            font-weight: 900;
            border-radius: 50px;
            background-color: #2e7d32;
            color: white;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        section.call-to-action a.cta-primary:hover,
        section.call-to-action a.cta-primary:focus {
            background-color: #1b5e20;
            outline: none;
        }

        /* FOOTER */
        footer {
            background-color: #004d40;
            color: #c8e6c9;
            padding: 3rem 0 2rem 0;
            margin-top: auto;
        }
        footer .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto 2rem auto;
        }
        footer .footer-brand .logo {
            font-weight: 900;
            font-size: 1.5rem;
            color: #a5d6a7;
            margin-bottom: 0.5rem;
            display: inline-block;
        }
        footer nav h4 {
            font-weight: 700;
            margin-bottom: 1rem;
            color: #81c784;
        }
        footer nav a {
            display: block;
            margin-bottom: 0.5rem;
            color: #c8e6c9;
            font-weight: 400;
        }
        footer nav a:hover,
        footer nav a:focus {
            color: #a5d6a7;
            outline: none;
        }
        footer .footer-bottom {
            text-align: center;
            font-size: 0.875rem;
            border-top: 1px solid #81c784;
            padding-top: 1rem;
        }

        /* Classes Edit & Delete boutons */
        .editBtn {
            background-color: #388e3c;
            color: #fff;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .editBtn:hover,
        .editBtn:focus {
            background-color: #2e7d32;
            outline: none;
        }
        .deleteBtn {
            background-color: #f44336;
            color: #fff;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .deleteBtn:hover,
        .deleteBtn:focus {
            background-color: #c62828;
            outline: none;
        }

        /* Reveal Animation */
        .reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: all 0.6s ease;
            will-change: opacity, transform;
        }
        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

    <header class="site-nav" id="site-nav" role="banner">
        <div class="container nav-inner">
            <div class="brand">
                <a href="{{ route('home') }}" class="logo" aria-label="GabonÉcho — Accueil">GabonÉcho</a>
                <div class="muted" style="font-size:.9rem">Le blog citoyen</div>
            </div>

            <form method="GET" action="{{ route('articles.index') }}" class="search-form" role="search" aria-label="Recherche d'articles">
                <input type="search" name="q" placeholder="Rechercher des articles, thèmes..." aria-label="Rechercher des articles" />
            </form>

            <nav class="main-nav" aria-label="Navigation principale de l'utilisateur">
                <a href="{{ route('articles.index') }}">Articles</a>

                @guest
                <a href="{{ route('login') }}">Connexion</a>
                <a href="{{ route('register') }}" class="cta cta-primary pulse">Inscription</a>
                @else
                <a href="{{ route('dashboard') }}" class="cta cta-primary" aria-label="Accéder à mon compte">Mon compte</a>
                @endguest
            </nav>
        </div>
    </header>

    <main id="main-content" role="main">
        <section class="hero">
            <div class="container copy reveal">
                <div class="eyebrow">Le Gabon au cœur de l'information</div>
                <h1>Découvrez les idées, débats et analyses de GabonÉcho</h1>
                <p class="lead">Un espace de partage d'articles et d'enquêtes approfondies sur la technologie, la sécurité, la vie publique et les initiatives citoyennes.</p>
                <p class="cta-links">
                    <a href="{{ route('articles.index') }}" class="cta cta-primary">
                        Explorer les articles
                        <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                    @guest
                    <a href="{{ route('register.form') }}" class="cta cta-secondary">S'inscrire</a>
                    @endguest
                </p>
            </div>

            <div class="visual reveal">
                <div class="carousel" id="hero-carousel" role="region" aria-label="Diaporama d'images principales" aria-live="polite">
                    <div class="carousel-item active-slide" role="group" aria-roledescription="slide" aria-label="1 of 7" id="slide-0" aria-hidden="false">
                        <img src="https://www.lepratiquedugabon.com/wp-content/uploads/2024/04/articel-loango-2-1536x663.jpg" alt="Parc National de Loango - Symbole de la biodiversité gabonaise" loading="eager" />
                    </div>
                    <div class="carousel-item" role="group" aria-roledescription="slide" aria-label="2 of 7" id="slide-1" aria-hidden="true">
                        <img src="https://prod.cdn-medias.jeuneafrique.com/cdn-cgi/image/q=auto,f=auto,metadata=none,width=1215,fit=cover/https://prod.cdn-medias.jeuneafrique.com/medias/2023/06/07/jad20230607-gfgabon-eco-as-incubation-sing-1-1256x628-1686208270.jpg" alt="Startup Gabonaise en pleine incubation - Symbole de l'innovation" loading="lazy" />
                    </div>
                    <div class="carousel-item" role="group" aria-roledescription="slide" aria-label="3 of 7" id="slide-2" aria-hidden="true">
                        <img src="https://ciberobs.com/wp-content/uploads/2020/08/hacking-3112539_960_720.png" alt="Graphique de cyber sécurité - Protection de l'espace numérique au Gabon" loading="lazy" />
                    </div>
                    <div class="carousel-item" role="group" aria-roledescription="slide" aria-label="4 of 7" id="slide-3" aria-hidden="true">
                        <img src="https://www.gabonreview.com/wp-content/uploads/2023/11/Democratie-Gabon.jpg" alt="Un groupe de personnes discutant - Symbole de la démocratie et du débat public au Gabon" loading="lazy" />
                    </div>
                    <div class="carousel-item" role="group" aria-roledescription="slide" aria-label="5 of 7" id="slide-4" aria-hidden="true">
                        <img src="https://convergenceafrique.net/wp-content/uploads/2020/11/enfants-education-ecole-ecolier-classe-apprentissage.jpg" alt="Enfants en classe - Symbole de l'éducation et de l'avenir du Gabon" loading="lazy" />
                    </div>
                    <div class="carousel-item" role="group" aria-roledescription="slide" aria-label="6 of 7" id="slide-5" aria-hidden="true">
                        <img src="http://news.alibreville.com/img_photos/L/danse(1).jpg" alt="Danseurs traditionnels gabonais - Symbole de la culture et du patrimoine" loading="lazy" />
                    </div>
                    <div class="carousel-item" role="group" aria-roledescription="slide" aria-label="7 of 7" id="slide-6" aria-hidden="true">
                        <img src="https://topinfosgabon.com/images/uploads/5fd476ce8bd77443666623.png" alt="Globe avec des personnes connectées - Symbole de la diaspora gabonaise" loading="lazy" />
                    </div>

                    <div class="carousel-dots" id="carousel-dots-container" role="tablist" aria-label="Contrôles du diaporama"></div>
                </div>
            </div>
        </section>

        <!-- ... Le reste du code articles, CTA, footer ... -->

        <section class="articles-section reveal">
            <div class="container">
                <h2 class="section-title reveal" role="heading" aria-level="2" style="text-align:center;">🔥 Tendances Actuelles</h2>

                <div class="articles-grid">
                    @if($articles->count() > 0)
                        @foreach($articles as $index => $article)
                        <article
                            class="article-card reveal"
                            style="transition-delay: {{ $index * 0.1 }}s;"
                            data-article-id="{{ $article->id }}"
                            aria-labelledby="article-title-{{ $article->id }}"
                        >
                            <a href="{{ route('articles.show', ['article' => $article->id]) }}" class="article-link" aria-label="Lire l'article: {{ $article->title }}">
                                <div
                                    class="image-placeholder"
                                    style="background-image: url('{{ asset($article->image) }}');"
                                    aria-hidden="true"
                                ></div>

                                <span class="badge badge-{{ $article->category_class }}" aria-label="Catégorie: {{ $article->category_name }}">
                                    {{ $article->category_name }}
                                </span>

                                <h3 id="article-title-{{ $article->id }}">{{ $article->title }}</h3>

                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($article->content), 150) }}</p>

                                <div class="metadata" aria-label="Informations sur l'article">
                                    <span>Par {{ $article->author->name }}</span>
                                    <span>{{ $article->reading_time }} min de lecture</span>
                                </div>
                            </a>

                            <div class="article-actions">
                                @auth
                                    <form method="POST" action="{{ route('articles.like', $article) }}" class="form-inline">
                                        @csrf
                                        <button type="submit" class="btn-action like-btn" aria-label="Aimer cet article">
                                            <i class="fas fa-thumbs-up" aria-hidden="true"></i>
                                            <span class="like-count">{{ $article->likes_count }}</span>
                                        </button>
                                    </form>

                                    <button
                                        class="btn-action comment-btn"
                                        data-article-id="{{ $article->id }}"
                                        aria-expanded="false"
                                        aria-controls="comments-{{ $article->id }}"
                                        aria-label="Afficher les commentaires pour {{ $article->title }}"
                                    >
                                        <i class="fas fa-comments" aria-hidden="true"></i>
                                        Commenter ({{ $article->comments_count }})
                                    </button>
                                @else
                                    <a href="{{ route('login') }}" class="btn-action btn-like" aria-label="Se connecter pour aimer">
                                        <i class="fas fa-thumbs-up" aria-hidden="true"></i> J'aime
                                    </a>
                                    <a href="{{ route('login') }}" class="btn-action btn-comment" aria-label="Se connecter pour commenter">
                                        <i class="fas fa-comments" aria-hidden="true"></i> Commenter ({{ $article->comments_count }})
                                    </a>
                                @endauth

                                @auth
                                    @if(auth()->id() === $article->author_id)
                                    <button class="btn-action btn-edit" data-article-id="{{ $article->id }}" aria-label="Modifier l'article {{ $article->title }}">
                                        <i class="fas fa-edit" aria-hidden="true"></i> Modifier
                                    </button>
                                    <button class="btn-action btn-delete" data-article-id="{{ $article->id }}" aria-label="Supprimer l'article {{ $article->title }}">
                                        <i class="fas fa-trash" aria-hidden="true"></i> Supprimer
                                    </button>
                                    @endif
                                @endauth
                            </div>

                            <section
                                class="comments-section"
                                id="comments-{{ $article->id }}"
                                hidden
                                aria-live="polite"
                                aria-label="Commentaires pour l'article {{ $article->title }}"
                            >
                                @foreach($article->comments as $comment)
                                <div class="comment">
                                    <strong>{{ $comment->user->name }}</strong>
                                    <small class="comment-date">{{ $comment->created_at->diffForHumans() }}</small>
                                    <p>{{ $comment->content }}</p>
                                </div>
                                @endforeach

                                @auth
                                <form class="add-comment-form" method="POST" action="{{ route('comments.store', $article) }}" data-article-id="{{ $article->id }}">
                                    @csrf
                                    <input
                                        type="text"
                                        name="content"
                                        placeholder="Écrire un commentaire..."
                                        required
                                        class="comment-input"
                                        aria-label="Écrire un commentaire pour l'article {{ $article->title }}"
                                    >
                                    <button type="submit" class="btn-submit-comment">
                                        Envoyer
                                    </button>
                                </form>
                                @else
                                <p><a href="{{ route('login') }}">Connectez-vous</a> pour commenter.</p>
                                @endauth
                            </section>
                        </article>
                        @endforeach
                    @else
                        <p class="no-articles-message" role="alert" style="text-align:center; font-style: italic; color: gray; margin-top: 2rem;">
                            Aucun article publié pour le moment. Revenez bientôt pour découvrir les dernières tendances !
                        </p>
                    @endif
                </div>
            </div>
        </section>

        <section class="call-to-action reveal" aria-labelledby="cta-heading">
            <div class="container">
                <h2 id="cta-heading" class="reveal">Contribuez à la conversation nationale</h2>
                <p class="lead reveal">Rejoignez des milliers de lecteurs et partagez vos analyses pour un Gabon meilleur.</p>
                <a href="{{ route('register.form') }}" class="cta cta-primary reveal" style="transition-delay: 0.3s;">Devenir Auteur</a>
            </div>
        </section>
    </main>

    <footer role="contentinfo">
        <div class="container footer-grid">
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="logo">GabonÉcho</a>
                <div class="muted">Le blog citoyen libre et indépendant.</div>
                <p style="margin-top:1.5rem;font-size:0.9rem;color:rgba(255,255,255,0.7)">
                    GabonÉcho est une plateforme dédiée au débat constructif et à l'information éclairée.
                </p>
            </div>
            <nav aria-label="Navigation du pied de page - Liens Rapides">
                <h4>Navigation</h4>
                <a href="{{ route('articles.index') }}">Articles</a>
                <a href="#">Thèmes</a>
                <a href="#">À Propos</a>
                <a href="#">Contact</a>
            </nav>
            <nav aria-label="Navigation du pied de page - Espace Utilisateur">
                <h4>Espace Utilisateur</h4>
                <a href="{{ route('login') }}">Connexion</a>
                <a href="{{ route('register') }}">Inscription</a>
                <a href="{{ route('user.dashboard') }}">Mon Compte</a>
            </nav>
            <nav aria-label="Navigation du pied de page - Catégories">
                <h4>Catégories</h4>
                <a href="#">Technologie</a>
                <a href="#">Sécurité</a>
                <a href="#">Vie Publique</a>
                <a href="#">Citoyenneté</a>
            </nav>
        </div>
        <div class="container footer-bottom">
            &copy; 2025 GabonÉcho. Tous droits réservés. | <a href="#" style="display:inline;color:inherit;">Mentions Légales</a>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const reveals = document.querySelectorAll('.reveal');

            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };

            const observerCallback = (entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('active');
                        observer.unobserve(entry.target);
                    }
                });
            };

            const observer = new IntersectionObserver(observerCallback, observerOptions);

            reveals.forEach(el => {
                observer.observe(el);
            });

            const carousel = document.getElementById('hero-carousel');
            if (carousel) {
                const items = carousel.querySelectorAll('.carousel-item');
                const dotsContainer = document.getElementById('carousel-dots-container');
                let currentIndex = 0;
                let intervalId;
                const totalSlides = items.length;

                items.forEach((item, index) => {
                    const dot = document.createElement('button');
                    dot.classList.add('dot');
                    dot.setAttribute('role', 'tab');
                    dot.setAttribute('aria-controls', 'slide-' + index);
                    dot.setAttribute('aria-label', 'Aller à la diapositive ' + (index + 1));
                    dot.id = 'dot-' + index;

                    if (index === 0) {
                        dot.classList.add('active-dot');
                        dot.setAttribute('aria-selected', 'true');
                    } else {
                        dot.setAttribute('aria-selected', 'false');
                    }

                    dot.addEventListener('click', () => {
                        showSlide(index);
                        resetInterval();
                    });
                    dotsContainer.appendChild(dot);
                });

                const dots = dotsContainer.querySelectorAll('.dot');

                function showSlide(index) {
                    items.forEach((item, idx) => {
                        item.classList.toggle('active-slide', idx === index);
                        item.setAttribute('aria-hidden', idx !== index);
                        item.id = 'slide-' + idx;
                    });

                    dots.forEach((dot, idx) => {
                        dot.classList.toggle('active-dot', idx === index);
                        dot.setAttribute('aria-selected', idx === index ? 'true' : 'false');
                        dot.setAttribute('aria-controls', 'slide-' + idx);
                    });

                    currentIndex = index;
                }

                function nextSlide() {
                    const nextIndex = (currentIndex + 1) % totalSlides;
                    showSlide(nextIndex);
                }

                function startInterval() {
                    if (totalSlides > 1) {
                        intervalId = setInterval(nextSlide, 5000);
                    }
                }

                function resetInterval() {
                    clearInterval(intervalId);
                    startInterval();
                }

                showSlide(0);
                startInterval();

                carousel.addEventListener('mouseenter', () => clearInterval(intervalId));
                carousel.addEventListener('mouseleave', resetInterval);
            }
        });
    </script>
</body>
</html>
