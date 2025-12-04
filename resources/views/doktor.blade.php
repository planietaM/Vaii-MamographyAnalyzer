<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitajte doktor - Mamography Analyzer</title>
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
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #a21caf;
            transform: translateY(-50%) scale(1.05);
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

        /* Doctor Dashboard */
        .doctor-dashboard {
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
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.12);
        }

        .stat-icon {
            font-size: 2.5rem;
        }

        .stat-info {
            flex: 1;
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

        /* Pending Cases */
        .pending-section {
            margin-bottom: 3rem;
        }

        .case-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .case-item {
            background: #fff;
            padding: 1.5rem;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
            display: grid;
            grid-template-columns: auto 1fr auto auto;
            align-items: center;
            gap: 1.5rem;
            transition: all 0.3s ease;
        }

        .case-item:hover {
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.1);
        }

        .case-priority {
            width: 8px;
            height: 50px;
            border-radius: 4px;
        }

        .priority-high {
            background: #ef4444;
        }

        .priority-medium {
            background: #f59e0b;
        }

        .priority-normal {
            background: #10b981;
        }

        .case-info h4 {
            font-size: 1.05rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
            color: #111827;
        }

        .case-details {
            font-size: 0.85rem;
            color: #6b7280;
        }

        .case-date {
            font-weight: 600;
            color: #c026d3;
            font-size: 0.9rem;
        }

        .case-action {
            display: flex;
            gap: 0.5rem;
        }

        .btn-view, .btn-analyze {
            padding: 0.5rem 1.25rem;
            border-radius: 0.5rem;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-view {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-view:hover {
            background: #e5e7eb;
        }

        .btn-analyze {
            background: #c026d3;
            color: #fff;
        }

        .btn-analyze:hover {
            background: #a21caf;
        }

        /* Recent Activity */
        .activity-section {
            margin-bottom: 3rem;
        }

        .activity-list {
            background: #fff;
            padding: 1.5rem;
            border-radius: 1.25rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        }

        .activity-item {
            padding: 1rem 0;
            border-bottom: 1px solid #f3f4f6;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            font-size: 1.5rem;
        }

        .activity-content {
            flex: 1;
        }

        .activity-text {
            font-size: 0.95rem;
            color: #374151;
            margin-bottom: 0.25rem;
        }

        .activity-time {
            font-size: 0.8rem;
            color: #9ca3af;
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

            .btn-primary:hover {
                transform: scale(1.05);
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
            .pending-section,
            .activity-section {
                padding-inline: 0.75rem;
            }

            .action-grid {
                grid-template-columns: 1fr;
            }

            .case-item {
                grid-template-columns: auto 1fr;
                gap: 1rem;
            }

            .case-action {
                grid-column: 2;
                flex-direction: column;
            }

            .btn-view, .btn-analyze {
                width: 100%;
            }
        }
    </style>
</head>

<body>

<header>
    <div class="container nav">
        <div class="nav-left">
            <ul class="nav-links">
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Pacienti</a></li>
                <li><a href="#">Vyšetrenia</a></li>
                <li><a href="#">Štatistiky</a></li>
                <li><a href="#">Nastavenia</a></li>
            </ul>
        </div>

        <button class="btn-primary">Odhlásiť sa</button>
    </div>
</header>

<section class="welcome-hero">
    <div class="container">
        <div class="welcome-content">
            <h1 class="welcome-title">Vitajte, Dr. Nováková</h1>
            <p class="welcome-subtitle">
                Prehľad vašich pacientov a čakajúcich vyšetrení
            </p>
        </div>
    </div>
</section>

<div class="container">
    <section class="doctor-dashboard">

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-info">
                    <div class="stat-number">47</div>
                    <div class="stat-label">Aktívni pacienti</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-info">
                    <div class="stat-number">8</div>
                    <div class="stat-label">Dnes dokončené</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-info">
                    <div class="stat-number">156</div>
                    <div class="stat-label">Celkovo analýz</div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="actions-section">
            <h2 class="section-title">Nová analýza</h2>

            <div class="action-grid" style="grid-template-columns: 1fr; max-width: 500px; margin: 0 auto;">
                <div class="action-card action-primary">
                    <div class="action-icon">🔬</div>
                    <h3 class="action-title">Analyzovať mamografické snímky</h3>
                    <p class="action-desc">Nahrať a analyzovať nové mamografické snímky pomocou AI</p>
                </div>
            </div>
        </div>

        <!-- Recent Analyses -->
        <div class="pending-section">
            <h2 class="section-title">Posledné analýzy</h2>

            <div class="case-list">
                <div class="case-item">
                    <div class="case-priority priority-normal"></div>
                    <div class="case-info">
                        <h4>Anna Malá (ID: 2850)</h4>
                        <p class="case-details">Mamografia - Preventívna prehliadka • Vek: 54 rokov • Výsledok: Negatívny</p>
                    </div>
                    <div class="case-date">02.12.2024</div>
                    <div class="case-action">
                        <button class="btn-view">Zobraziť</button>
                    </div>
                </div>

                <div class="case-item">
                    <div class="case-priority priority-normal"></div>
                    <div class="case-info">
                        <h4>Petra Varga (ID: 2849)</h4>
                        <p class="case-details">Mamografia - Ročná kontrola • Vek: 58 rokov • Výsledok: Negatívny</p>
                    </div>
                    <div class="case-date">02.12.2024</div>
                    <div class="case-action">
                        <button class="btn-view">Zobraziť</button>
                    </div>
                </div>

                <div class="case-item">
                    <div class="case-priority priority-medium"></div>
                    <div class="case-info">
                        <h4>Mária Horváthová (ID: 2848)</h4>
                        <p class="case-details">Mamografia - Kontrolné vyšetrenie • Vek: 52 rokov • Výsledok: Vyžaduje pozornosť</p>
                    </div>
                    <div class="case-date">01.12.2024</div>
                    <div class="case-action">
                        <button class="btn-view">Zobraziť</button>
                    </div>
                </div>

                <div class="case-item">
                    <div class="case-priority priority-normal"></div>
                    <div class="case-info">
                        <h4>Jana Kováčová (ID: 2847)</h4>
                        <p class="case-details">Mamografia - Skríning • Vek: 48 rokov • Výsledok: Negatívny</p>
                    </div>
                    <div class="case-date">01.12.2024</div>
                    <div class="case-action">
                        <button class="btn-view">Zobraziť</button>
                    </div>
                </div>

                <div class="case-item">
                    <div class="case-priority priority-normal"></div>
                    <div class="case-info">
                        <h4>Eva Szabová (ID: 2846)</h4>
                        <p class="case-details">Mamografia - Preventívna prehliadka • Vek: 61 rokov • Výsledok: Negatívny</p>
                    </div>
                    <div class="case-date">30.11.2024</div>
                    <div class="case-action">
                        <button class="btn-view">Zobraziť</button>
                    </div>
                </div>

                <div class="case-item">
                    <div class="case-priority priority-normal"></div>
                    <div class="case-info">
                        <h4>Lucia Dvořáková (ID: 2845)</h4>
                        <p class="case-details">Mamografia - Ročná kontrola • Vek: 45 rokov • Výsledok: Negatívny</p>
                    </div>
                    <div class="case-date">30.11.2024</div>
                    <div class="case-action">
                        <button class="btn-view">Zobraziť</button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

</body>
</html>
