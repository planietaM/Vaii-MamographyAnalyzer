<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Mamography Analyzer</title>
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
            max-width: 1400px;
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

        /* Admin Dashboard */
        .admin-dashboard {
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

        /* Section */
        .section {
            margin-bottom: 3rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 800;
            color: #111827;
        }

        .btn-add {
            background: #c026d3;
            color: #fff;
            padding: 0.65rem 1.5rem;
            border-radius: 0.75rem;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-add:hover {
            background: #a21caf;
            transform: translateY(-2px);
        }

        /* Table Container */
        .table-container {
            background: #fff;
            border-radius: 1.25rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f9fafb;
        }

        th {
            padding: 1rem 1.5rem;
            text-align: left;
            font-size: 0.875rem;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            padding: 1rem 1.5rem;
            border-top: 1px solid #f3f4f6;
            font-size: 0.95rem;
        }

        tbody tr {
            transition: all 0.2s ease;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #c026d3 0%, #d04fa7 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
            font-size: 0.95rem;
        }

        .user-details h4 {
            font-size: 0.95rem;
            font-weight: 600;
            color: #111827;
            margin-bottom: 0.125rem;
        }

        .user-details p {
            font-size: 0.85rem;
            color: #6b7280;
        }

        .status-badge {
            display: inline-block;
            padding: 0.375rem 0.875rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-active {
            background: #d1fae5;
            color: #065f46;
        }

        .status-inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .table-actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-view {
            background: #f3f4f6;
            color: #374151;
        }

        .btn-view:hover {
            background: #e5e7eb;
        }

        .btn-edit {
            background: #dbeafe;
            color: #1e40af;
        }

        .btn-edit:hover {
            background: #bfdbfe;
        }

        .btn-delete {
            background: #fee2e2;
            color: #991b1b;
        }

        .btn-delete:hover {
            background: #fecaca;
        }

        /* Search Bar (CSS pre vyhľadávací panel som ponechal, aj keď sa nepoužíva v HTML, pre prípadné budúce využitie, ale zmazal som to, čo bolo relevantné pre HTML) */
        .search-bar {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f3f4f6;
        }

        .search-input {
            width: 100%;
            max-width: 400px;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            outline: none;
            border-color: #c026d3;
            box-shadow: 0 0 0 3px rgba(192, 38, 211, 0.1);
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
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-add {
                width: 100%;
                justify-content: center;
            }

            .table-actions {
                flex-direction: column;
            }

            .btn-action {
                width: 100%;
            }

            th, td {
                padding: 0.75rem 1rem;
                font-size: 0.875rem;
            }

            .search-input {
                max-width: 100%;
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
                <li><a href="#">Doktori</a></li>
                <li><a href="#">Pacienti</a></li>
                <li><a href="#">Štatistiky</a></li>
                <li><a href="#">Nastavenia</a></li>
            </ul>
        </div>

        <button class="btn-primary" onclick="handleLogout()">Odhlásiť sa</button>
    </div>
</header>

<section class="welcome-hero">
    <div class="container">
        <div class="welcome-content">
            <h1 class="welcome-title">Admin Dashboard</h1>
            <p class="welcome-subtitle">
                Správa doktorov, pacientov a systému
            </p>
        </div>
    </div>
</section>

<div class="container">
    <section class="admin-dashboard">

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">👨‍⚕️</div>
                <div class="stat-info">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Celkovo doktorov</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-info">
                    <div class="stat-number">284</div>
                    <div class="stat-label">Celkovo pacientov</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-info">
                    <div class="stat-number">1,247</div>
                    <div class="stat-label">Vykonaných analýz</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-info">
                    <div class="stat-number">23</div>
                    <div class="stat-label">Dnes vykonaných</div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Doktori</h2>
                <button class="btn-add">
                    <span>➕</span>
                    <span>Pridať doktora</span>
                </button>
            </div>

            <div class="table-container">
                <div class="table-wrapper">
                    <table>
                        <thead>
                        <tr>
                            <th>Doktor</th>
                            <th>Špecializácia</th>
                            <th>Email</th>
                            <th>Telefón</th>
                            <th>Pacientov</th>
                            <th>Stav</th>
                            <th>Akcie</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">DN</div>
                                    <div class="user-details">
                                        <h4>Dr. Jana Nováková</h4>
                                        <p>ID: DOC001</p>
                                    </div>
                                </div>
                            </td>
                            <td>Rádiológia</td>
                            <td>jana.novakova@clinic.sk</td>
                            <td>+421 912 345 678</td>
                            <td>47</td>
                            <td><span class="status-badge status-active">Aktívny</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn-action btn-view">Zobraziť</button>
                                    <button class="btn-action btn-edit">Upraviť</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">PH</div>
                                    <div class="user-details">
                                        <h4>Dr. Peter Horváth</h4>
                                        <p>ID: DOC002</p>
                                    </div>
                                </div>
                            </td>
                            <td>Rádiológia</td>
                            <td>peter.horvath@clinic.sk</td>
                            <td>+421 903 456 789</td>
                            <td>52</td>
                            <td><span class="status-badge status-active">Aktívny</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn-action btn-view">Zobraziť</button>
                                    <button class="btn-action btn-edit">Upraviť</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">EK</div>
                                    <div class="user-details">
                                        <h4>Dr. Eva Kováčová</h4>
                                        <p>ID: DOC003</p>
                                    </div>
                                </div>
                            </td>
                            <td>Onkológia</td>
                            <td>eva.kovacova@clinic.sk</td>
                            <td>+421 905 567 890</td>
                            <td>38</td>
                            <td><span class="status-badge status-active">Aktívny</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn-action btn-view">Zobraziť</button>
                                    <button class="btn-action btn-edit">Upraviť</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">MS</div>
                                    <div class="user-details">
                                        <h4>Dr. Mária Szabová</h4>
                                        <p>ID: DOC004</p>
                                    </div>
                                </div>
                            </td>
                            <td>Rádiológia</td>
                            <td>maria.szabova@clinic.sk</td>
                            <td>+421 917 678 901</td>
                            <td>41</td>
                            <td><span class="status-badge status-inactive">Neaktívny</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn-action btn-view">Zobraziť</button>
                                    <button class="btn-action btn-edit">Upraviť</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">JV</div>
                                    <div class="user-details">
                                        <h4>Dr. Ján Varga</h4>
                                        <p>ID: DOC005</p>
                                    </div>
                                </div>
                            </td>
                            <td>Chirurgia</td>
                            <td>jan.varga@clinic.sk</td>
                            <td>+421 908 789 012</td>
                            <td>35</td>
                            <td><span class="status-badge status-active">Aktívny</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn-action btn-view">Zobraziť</button>
                                    <button class="btn-action btn-edit">Upraviť</button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Pacienti</h2>
                <button class="btn-add">
                    <span>➕</span>
                    <span>Pridať pacienta</span>
                </button>
            </div>

            <div class="table-container">
                <div class="table-wrapper">
                    <table>
                        <thead>
                        <tr>
                            <th>Pacient</th>
                            <th>Vek</th>
                            <th>Email</th>
                            <th>Telefón</th>
                            <th>Ošetrujúci lekár</th>
                            <th>Posledné vyšetrenie</th>
                            <th>Stav</th>
                            <th>Akcie</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">AM</div>
                                    <div class="user-details">
                                        <h4>Anna Malá</h4>
                                        <p>ID: PAT2850</p>
                                    </div>
                                </div>
                            </td>
                            <td>54 rokov</td>
                            <td>anna.mala@email.sk</td>
                            <td>+421 911 234 567</td>
                            <td>Dr. Nováková</td>
                            <td>02.12.2024</td>
                            <td><span class="status-badge status-active">Aktívny</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn-action btn-view">Zobraziť</button>
                                    <button class="btn-action btn-edit">Upraviť</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">PV</div>
                                    <div class="user-details">
                                        <h4>Petra Varga</h4>
                                        <p>ID: PAT2849</p>
                                    </div>
                                </div>
                            </td>
                            <td>58 rokov</td>
                            <td>petra.varga@email.sk</td>
                            <td>+421 902 345 678</td>
                            <td>Dr. Nováková</td>
                            <td>02.12.2024</td>
                            <td><span class="status-badge status-active">Aktívny</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn-action btn-view">Zobraziť</button>
                                    <button class="btn-action btn-edit">Upraviť</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">MH</div>
                                    <div class="user-details">
                                        <h4>Mária Horváthová</h4>
                                        <p>ID: PAT2848</p>
                                    </div>
                                </div>
                            </td>
                            <td>52 rokov</td>
                            <td>maria.horvath@email.sk</td>
                            <td>+421 904 456 789</td>
                            <td>Dr. Horváth</td>
                            <td>01.12.2024</td>
                            <td><span class="status-badge status-pending">Kontrola</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn-action btn-view">Zobraziť</button>
                                    <button class="btn-action btn-edit">Upraviť</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">JK</div>
                                    <div class="user-details">
                                        <h4>Jana Kováčová</h4>
                                        <p>ID: PAT2847</p>
                                    </div>
                                </div>
                            </td>
                            <td>48 rokov</td>
                            <td>jana.kovac@email.sk</td>
                            <td>+421 906 567 890</td>
                            <td>Dr. Kováčová</td>
                            <td>01.12.2024</td>
                            <td><span class="status-badge status-active">Aktívny</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn-action btn-view">Zobraziť</button>
                                    <button class="btn-action btn-edit">Upraviť</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">ES</div>
                                    <div class="user-details">
                                        <h4>Eva Szabová</h4>
                                        <p>ID: PAT2846</p>
                                    </div>
                                </div>
                            </td>
                            <td>61 rokov</td>
                            <td>eva.szabo@email.sk</td>
                            <td>+421 918 678 901</td>
                            <td>Dr. Nováková</td>
                            <td>30.11.2024</td>
                            <td><span class="status-badge status-active">Aktívny</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn-action btn-view">Zobraziť</button>
                                    <button class="btn-action btn-edit">Upraviť</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">LD</div>
                                    <div class="user-details">
                                        <h4>Lucia Dvořáková</h4>
                                        <p>ID: PAT2845</p>
                                    </div>
                                </div>
                            </td>
                            <td>45 rokov</td>
                            <td>lucia.dvorak@email.sk</td>
                            <td>+421 909 789 012</td>
                            <td>Dr. Varga</td>
                            <td>30.11.2024</td>
                            <td><span class="status-badge status-active">Aktívny</span></td>
                            <td>
                                <div class="table-actions">
                                    <button class="btn-action btn-view">Zobraziť</button>
                                    <button class="btn-action btn-edit">Upraviť</button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // URL k vášmu API
    const API_URL = 'http://127.0.0.1:8000/api';

    function handleLogout() {
        const token = localStorage.getItem('userToken');

        if (!token) {
            // Ak token neexistuje, presmeruj hneď
            window.location.href = '/prihlasenie';
            return;
        }

        // Volanie /api/logout s tokenom v hlavičke
        axios.post(`${API_URL}/logout`, {}, {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        })
            .finally(() => {
                // Zmazanie tokenu a presmerovanie, bez ohľadu na odpoveď servera
                localStorage.removeItem('userToken');
                localStorage.removeItem('user');

                // Jednoduchá notifikácia (môžete ju zmeniť za krajší UI prvok)
                alert('Boli ste úspešne odhlásený.');
                window.location.href = '/prihlasenie';
            });
    }
</script>

</body>
</html>
