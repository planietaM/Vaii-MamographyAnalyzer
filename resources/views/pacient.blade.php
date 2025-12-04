<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitajte pacient - Mamography Analyzer</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #f9fafb;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #111827;
            line-height: 1.5;
        }

        img {
            display: block;
            max-width: 100%;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding-inline: 1.5rem;
        }

        /* HEADER */
        header {
            padding-block: 1.25rem;
        }

        .nav {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .nav-left {
            display: flex;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .nav-links a {
            color: #c026d3;
            font-size: 0.95rem;
            font-weight: 500;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .btn-primary {
            position: absolute;
            right: clamp(1.5rem, 4vw, 3rem);
            top: 50%;
            transform: translateY(-50%);
            background: #c026d3;
            color: #fff !important;
            padding: 0.55rem 1.6rem;
            border-radius: 999px;
            font-size: 0.95rem;
            font-weight: 600;
            white-space: nowrap;
            cursor: pointer;
        }

        /* Welcome Hero */
        .welcome-hero {
            background: linear-gradient(135deg, #9c0b8e 0%, #d04fa7 100%);
            padding: 3rem 0;
            margin-bottom: 3rem;
        }

        .welcome-content {
            text-align: center;
            color: #fff;
        }

        .welcome-title {
            font-size: clamp(2rem, 4vw, 2.75rem);
            font-weight: 900;
            margin-bottom: 0.75rem;
        }

        .welcome-subtitle {
            font-size: clamp(1rem, 1.5vw, 1.15rem);
            opacity: 0.95;
        }

        /* Patient Dashboard */
        .patient-dashboard {
            padding-bottom: 4rem;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: #fff;
            padding: 1.75rem;
            border-radius: 1.25rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
            display: flex;
            align-items: center;
            gap: 1.25rem;
        }

        .stat-icon {
            font-size: 2.5rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 900;
            color: #c026d3;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #6b7280;
        }

        /* Section Title */
        .section-title {
            font-size: 1.75rem;
            font-weight: 800;
            margin-bottom: 1.75rem;
            color: #111827;
        }

        /* Actions Section */
        .actions-section {
            margin-bottom: 3rem;
        }

        .action-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.5rem;
        }

        .action-card {
            background: #fff;
            padding: 2rem 1.75rem;
            border-radius: 1.25rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
            text-align: center;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            cursor: pointer;
        }

        .action-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.12);
            border-color: #c026d3;
        }

        .action-primary {
            background: linear-gradient(135deg, #9c0b8e 0%, #d04fa7 100%);
            color: #fff;
        }

        .action-primary:hover {
            border-color: #9c0b8e;
        }

        .action-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .action-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .action-desc {
            font-size: 0.95rem;
            color: #6b7280;
        }

        .action-primary .action-desc {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Recent Examinations */
        .recent-section {
            margin-bottom: 3rem;
        }

        .exam-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .exam-item {
            background: #fff;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 1.5rem;
        }

        .exam-date {
            font-weight: 700;
            color: #c026d3;
            font-size: 0.95rem;
        }

        .exam-name {
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #111827;
        }

        .exam-status {
            font-size: 0.85rem;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            display: inline-block;
        }

        .status-completed {
            background: #d1fae5;
            color: #065f46;
        }

        .status-scheduled {
            background: #dbeafe;
            color: #1e40af;
        }

        .exam-link {
            color: #c026d3;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
        }

        .exam-link:hover {
            text-decoration: underline;
        }

        /* Mobile */
        @media (max-width: 768px) {
            header {
                padding-block: 0.75rem 0.5rem;
            }

            .nav {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }

            .nav-left {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-links {
                flex-direction: column;
                gap: 0.5rem;
            }

            .btn-primary {
                position: static;
                transform: none;
                margin-top: 0.75rem;
                align-self: flex-start;
            }

            .welcome-hero {
                padding: 2rem 0;
                margin-bottom: 2rem;
            }

            .stats-grid {
                grid-template-columns: 1fr;
                padding-inline: 0.75rem;
            }

            .actions-section,
            .recent-section {
                padding-inline: 0.75rem;
            }

            .action-grid {
                grid-template-columns: 1fr;
            }

            .exam-item {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .exam-link {
                justify-self: start;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="container nav">
        <div class="nav-left">
            <ul class="nav-links">
                <li><a href="#">Skríning rakoviny</a></li>
                <li><a href="#">Pacienti</a></li>
                <li><a href="#">O nás</a></li>
                <li><a href="#">Partneri</a></li>
                <li><a href="#">Kontaktujte nás</a></li>
            </ul>
        </div>

        <a href="#" class="btn-primary">Odhlásiť sa</a>
    </div>
</header>

<section class="welcome-hero">
    <div class="container">
        <div class="welcome-content">
            <h1 class="welcome-title">Vitajte, pacient</h1>
            <p class="welcome-subtitle">
                Tu nájdete prístup k vašim vyšetreniam a zdravotným záznamom
            </p>
        </div>
    </div>
</section>

<div class="container">
    <section class="patient-dashboard">

        <!-- Recent Examinations -->
        <div class="recent-section">
            <h2 class="section-title">Nedávne vyšetrenia</h2>

            <div class="exam-list">
                <div class="exam-item">
                    <div class="exam-date">15.11.2024</div>
                    <div class="exam-info">
                        <h4 class="exam-name">Mamografia - skríning</h4>
                        <p class="exam-status status-completed">Výsledok dostupný</p>
                    </div>
                    <a href="#" class="exam-link">Zobraziť</a>
                </div>

                <div class="exam-item">
                    <div class="exam-date">28.10.2024</div>
                    <div class="exam-info">
                        <h4 class="exam-name">Konzultácia - rádiológia</h4>
                        <p class="exam-status status-completed">Výsledok dostupný</p>
                    </div>
                    <a href="#" class="exam-link">Zobraziť</a>
                </div>

                <div class="exam-item">
                    <div class="exam-date">05.12.2024</div>
                    <div class="exam-info">
                        <h4 class="exam-name">Mamografia - kontrola</h4>
                        <p class="exam-status status-scheduled">Naplánované</p>
                    </div>
                    <a href="#" class="exam-link">Detail</a>
                </div>
            </div>
        </div>

    </section>
</div>

</body>
</html>
