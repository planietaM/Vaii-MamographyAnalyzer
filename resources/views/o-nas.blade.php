<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O nás - Mamography Analyzer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #f9fafb;
            min-height: 100vh;
            color: #111827;
            line-height: 1.5;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding-inline: 1.5rem;
        }

        /* Header */
        header {
            padding-block: 1.25rem;
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        .nav-links a {
            text-decoration: none;
            color: #111827;
            font-weight: 500;
            transition: color 0.2s;
        }

        .nav-links a:hover {
            color: #9c0b8e;
        }

        .btn-primary {
            background: linear-gradient(135deg, #9c0b8e 0%, #d04fa7 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 999px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(156, 11, 142, 0.3);
        }

        /* Hero sekcia */
        .about-hero {
            background: linear-gradient(135deg, #9c0b8e 0%, #d04fa7 100%);
            padding: 4rem 0 3rem;
            margin-bottom: 3rem;
            text-align: center;
            color: white;
        }

        .about-hero h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 900;
            margin-bottom: 1rem;
        }

        .about-hero p {
            font-size: clamp(1rem, 2vw, 1.25rem);
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Obsah */
        .about-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 1.5rem 4rem;
        }

        .about-card {
            background: white;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            margin-bottom: 2rem;
        }

        .about-card h2 {
            font-size: 2rem;
            color: #9c0b8e;
            margin-bottom: 1.5rem;
            font-weight: 800;
        }

        .about-card p {
            line-height: 1.8;
            color: #555;
            font-size: 1.05rem;
            margin-bottom: 1rem;
        }

        .about-card p:last-child {
            margin-bottom: 0;
        }

        .contact-info {
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: #f9fafb;
            border-radius: 1rem;
            border-left: 4px solid #9c0b8e;
        }

        .contact-info p {
            margin-bottom: 0.75rem;
        }

        .contact-info p:last-child {
            margin-bottom: 0;
        }

        .contact-info strong {
            color: #9c0b8e;
        }

        /* Mobile responzívnosť */
        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-links {
                flex-direction: column;
                text-align: center;
                gap: 0.75rem;
            }

            .about-hero {
                padding: 3rem 1.5rem 2rem;
                margin-bottom: 2rem;
            }

            .about-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>

<!-- Header z layouts/main.blade.php -->
<header>
    <div class="container nav">
        <ul class="nav-links">
            <li><a href="/">Domov</a></li>
            <li><a href="{{ route('skrining') }}">Skríning rakoviny</a></li>
            <li><a href="#">Pacienti</a></li>
            <li><a href="{{ route('o-nas') }}">O nás</a></li>
            <li><a href="#">Partneri</a></li>
            <li><a href="{{ route('users.list') }}">Kontaktujte nás</a></li>
        </ul>
        <a href="/prihlasenie" class="btn-primary">Prihlásenie</a>
    </div>
</header>

<!-- Hero sekcia -->
<section class="about-hero">
    <h1>O nás</h1>
    <p>Moderné riešenie pre mamografickú diagnostiku</p>
</section>

<!-- Obsah -->
<div class="about-content">
    <!-- Kto sme -->
    <div class="about-card">
        <h2>Kto sme</h2>
        <p>
            Sme tým odborníkov v oblasti zdravotníctva a IT, ktorí sa spojili v boji proti rakovine prsníka.
            Naša spoločnosť vznikla s víziou sprístupniť kvalitnú mamografickú diagnostiku všetkým ženám.
        </p>
        <p>
            <strong>Mamography Analyzer</strong> je inteligentný systém pre správu a analýzu mamografických
            vyšetrení. Našou misiou je zjednodušiť proces diagnostiky a umožniť lekárom efektívnejšie
            pracovať s pacientskymi údajmi.
        </p>
    </div>

    <!-- Technológia -->
    <div class="about-card">
        <h2>Naša technológia</h2>
        <p>
            Využívame najnovšie webové technológie a zabezpečenie údajov. Systém je postavený
            na Laravel frameworku s vysokou bezpečnosťou a stabilitou.
        </p>
        <p>
            Aplikácia je plne responzívna a funguje na všetkých zariadeniach. Všetky osobné
            a zdravotné údaje sú uchovávané v súlade s GDPR.
        </p>
    </div>

    <!-- Kontakt -->
    <div class="about-card">
        <h2>Kontaktujte nás</h2>
        <p>Máte otázky alebo záujem o našu službu? Radi vám pomôžeme!</p>
        <div class="contact-info">
            <p>📧 <strong>Email:</strong> info@mamographyanalyzer.sk</p>
            <p>📞 <strong>Telefón:</strong> +421 123 456 789</p>
            <p>📍 <strong>Adresa:</strong> Bratislava, Slovensko</p>
        </div>
    </div>
</div>


</body>
</html>

