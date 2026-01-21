<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skríning rakoviny - Mamography Analyzer</title>
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
        .screening-hero {
            background: linear-gradient(135deg, #9c0b8e 0%, #d04fa7 100%);
            padding: 4rem 0 3rem;
            margin-bottom: 3rem;
            text-align: center;
            color: white;
        }

        .screening-hero h1 {
            font-size: clamp(2.5rem, 5vw, 3.5rem);
            font-weight: 900;
            margin-bottom: 1rem;
        }

        .screening-hero p {
            font-size: clamp(1rem, 2vw, 1.25rem);
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Obsah */
        .screening-content {
            max-width: 900px;
            margin: 0 auto;
            padding: 0 1.5rem 4rem;
        }

        .screening-card {
            background: white;
            border-radius: 1.5rem;
            padding: 2.5rem;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            margin-bottom: 2rem;
        }

        .screening-card h2 {
            font-size: 2rem;
            color: #9c0b8e;
            margin-bottom: 1.5rem;
            font-weight: 800;
        }

        .screening-card h3 {
            font-size: 1.5rem;
            color: #333;
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .screening-card p {
            line-height: 1.8;
            color: #555;
            font-size: 1.05rem;
            margin-bottom: 1rem;
        }

        .screening-card ul {
            list-style: none;
            margin-top: 1rem;
        }

        .screening-card ul li {
            padding-left: 1.5rem;
            position: relative;
            margin-bottom: 0.75rem;
            color: #555;
            line-height: 1.8;
        }

        .screening-card ul li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #9c0b8e;
            font-weight: 900;
        }

        .info-box {
            margin-top: 1.5rem;
            padding: 1.5rem;
            background: #f0e8f6;
            border-radius: 1rem;
            border-left: 4px solid #9c0b8e;
        }

        .info-box p {
            margin-bottom: 0.5rem;
        }

        .info-box p:last-child {
            margin-bottom: 0;
        }

        .info-box strong {
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

            .screening-hero {
                padding: 3rem 1.5rem 2rem;
                margin-bottom: 2rem;
            }

            .screening-card {
                padding: 2rem 1.5rem;
            }
        }
    </style>
</head>
<body>

<!-- Header -->
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
<section class="screening-hero">
    <h1>Skríning rakoviny prsníka</h1>
    <p>Pravidelné vyšetrenie môže zachrániť život</p>
</section>

<!-- Obsah -->
<div class="screening-content">
    <!-- Čo je skríning -->
    <div class="screening-card">
        <h2>Čo je skríning rakoviny prsníka?</h2>
        <p>
            Skríning rakoviny prsníka je preventívne vyšetrenie, ktoré má za cieľ odhaliť rakovinu
            v čo najskoršom štádiu, kedy je liečba najúčinnejšia. Hlavnou metódou skríningu je
            mamografia - röntgenové vyšetrenie prsníkov.
        </p>
        <p>
            Pravidelný skríning výrazne zvyšuje šancu na včasné odhalenie ochorenia a úspešnú liečbu.
            Väčšina prípadov rakoviny prsníka odhalených pri skríningu je v ranom štádiu, čo znamená
            lepšiu prognózu a šetrnejšiu liečbu.
        </p>
    </div>

    <!-- Prečo je dôležitý -->
    <div class="screening-card">
        <h2>Prečo je skríning dôležitý?</h2>
        <p>
            Rakovina prsníka je najčastejším zhubným nádorom u žien. Včasné odhalenie výrazne
            zvyšuje šancu na úplné vyliečenie.
        </p>
        <ul>
            <li>Odhalenie v ranom štádiu zvyšuje šancu na úspešnú liečbu na viac ako 90%</li>
            <li>Umožňuje šetrnejšiu liečbu a zachovanie prsníka</li>
            <li>Znižuje potrebu agresívnej chemoterapie</li>
            <li>Zlepšuje kvalitu života počas a po liečbe</li>
        </ul>
    </div>

    <!-- Kedy na vyšetrenie -->
    <div class="screening-card">
        <h2>Kedy ísť na vyšetrenie?</h2>

        <h3>Odporúčania pre ženy bez zvýšeného rizika:</h3>
        <ul>
            <li><strong>40-49 rokov:</strong> Konzultácia s lekárom o individuálnom riziku</li>
            <li><strong>50-69 rokov:</strong> Mamografia každé 2 roky (štandardný skríning)</li>
            <li><strong>70+ rokov:</strong> Individuálne rozhodnutie s lekárom</li>
        </ul>

        <h3>Zvýšené riziko (rodinná anamnéza, genetické mutácie):</h3>
        <ul>
            <li>Začať skríning skôr (podľa odporúčania lekára)</li>
            <li>Častejšie kontroly</li>
            <li>Doplnkové vyšetrenia (ultrazvuk, MRI)</li>
        </ul>

        <div class="info-box">
            <p><strong>💡 Dôležité:</strong></p>
            <p>
                Neváhajte navštíviť lekára aj medzi pravidelnými kontrolami, ak spozorujete
                akúkoľvek zmenu na prsníkoch - hrčku, zmenu tvaru, vtlačenie bradavky,
                výtok alebo zmenu kože.
            </p>
        </div>
    </div>

    <!-- Ako prebieha -->
    <div class="screening-card">
        <h2>Ako prebieha mamografické vyšetrenie?</h2>
        <p>
            Mamografia je rýchle a bezpečné vyšetrenie, ktoré trvá približne 15-20 minút:
        </p>
        <ul>
            <li>Vyšetrenie vykonáva kvalifikovaný radiologický asistent</li>
            <li>Prsník sa umiestni medzi dve platne prístroja</li>
            <li>Vytvorí sa niekoľko röntgenových snímok z rôznych uhlov</li>
            <li>Vyšetrenie môže byť mierne nepríjemné, ale nie bolestivé</li>
            <li>Výsledky vyhodnotí skúsený rádiológ</li>
        </ul>

        <div class="info-box">
            <p><strong>📋 Príprava na vyšetrenie:</strong></p>
            <p>
                V deň vyšetrenia nepoužívajte dezodorant, telové mlieko ani púder v oblasti
                prsníkov a podpazušia - mohli by ovplyvniť kvalitu snímok.
            </p>
        </div>
    </div>

    <!-- Naše služby -->
    <div class="screening-card">
        <h2>Naše služby</h2>
        <p>
            V rámci systému Mamography Analyzer poskytujeme:
        </p>
        <ul>
            <li>Digitálnu správu vašich mamografických vyšetrení</li>
            <li>Okamžitý prístup k výsledkom online</li>
            <li>Bezpečné uloženie všetkých snímok a nálezov</li>
            <li>Pripomienky termínov pravidelných kontrol</li>
            <li>Komunikáciu s vaším lekárom cez zabezpečenú platformu</li>
        </ul>
        <p style="margin-top: 1.5rem;">
            <a href="/prihlasenie" class="btn-primary">Prihláste sa do systému</a>
        </p>
    </div>
</div>

</body>
</html>

