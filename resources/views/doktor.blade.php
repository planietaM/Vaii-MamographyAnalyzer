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
            line-height: 1.50;
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
        }

        /* Welcome Hero */
        .welcome-hero {
            background: linear-gradient(135deg, #9c0b8e 0%, #d04fa7 100%);
            padding: 3rem 0;
            margin-bottom: 3rem;
            position: relative;
        }

        /* Logout button placed inside welcome hero */
        .hero-logout {
            position: absolute;
            right: clamp(1.5rem, 4vw, 3rem);
            top: 1.25rem;
            background: #fff;
            color: #9c0b8e;
            border: 2px solid rgba(255,255,255,0.08);
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }
        .hero-logout:hover { transform: translateY(-2px); }

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
            background: #f9fafb;
            padding: 1.75rem;
            border-radius: 0.75rem;
            display: flex;
            align-items: center;
            gap: 1.25rem;
            transition: all 0.3s ease;
            border: 1px solid #f3f4f6;
        }

        .stat-card:hover {
            background: #f3f4f6;
            border-color: #e5e7eb;
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

        .add-exam-btn {
            background: linear-gradient(135deg, #9c0b8e 0%, #d04fa7 100%);
            color: #fff;
            padding: 0.75rem 1.75rem;
            border-radius: 0.75rem;
            font-size: 1rem;
            font-weight: 700;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(192, 38, 211, 0.3);
            margin-bottom: 2rem;
        }

        .add-exam-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(192, 38, 211, 0.4);
        }

        /* Exams Table - Admin style */
        .exam-table-wrapper {
            background: #fff;
            border-radius: 1.25rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
            overflow: visible;
            margin-top: 2rem;
        }

        .table-wrapper {
            overflow-x: auto;
            border-radius: 1.25rem;
            background: #fff;
        }

        .exam-table {
            width: 100%;
            border-collapse: collapse;
        }

        .exam-table thead {
            background: #f9fafb;
        }

        .exam-table th {
            padding: 1rem 1.5rem;
            text-align: left;
            font-size: 0.875rem;
            font-weight: 700;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid #e5e7eb;
        }

        .exam-table td {
            padding: 1rem 1.5rem;
            border-top: 1px solid #f3f4f6;
            font-size: 0.95rem;
        }


        .exam-date {
            font-weight: 600;
            color: #c026d3;
        }

        .exam-status {
            display: inline-block;
            padding: 0.375rem 0.875rem;
            border-radius: 999px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .status-positive {
            background: #d1fae5;
            color: #065f46;
        }

        .status-negative {
            background: #fee2e2;
            color: #991b1b;
        }

        .status-unknown {
            background: #f3f4f6;
            color: #6b7280;
        }

        .exam-actions {
            display: flex;
            gap: 0.5rem;
        }


        .btn-view, .btn-edit, .btn-delete {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
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

        .no-exams {
            text-align: center;
            padding: 3rem 2rem;
            color: #6b7280;
            font-size: 1rem;
        }

        /* Modal dialóg */
        .modal-dialog {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-dialog.active {
            display: flex;
        }

        .modal-content-box {
            background: #fff;
            padding: 1.5rem;
            border-radius: 0.75rem;
            width: 95%;
            max-width: 600px;
            max-height: 90vh;
            overflow-y: auto;
        }

        .modal-content-box h3 {
            margin-bottom: 1rem;
            font-size: 1.25rem;
            color: #111827;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #374151;
            font-size: 0.95rem;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            font-size: 0.95rem;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #c026d3;
            box-shadow: 0 0 0 3px rgba(192, 38, 211, 0.1);
        }

        .modal-actions {
            display: flex;
            gap: 0.75rem;
            justify-content: flex-end;
        }

        .btn-save {
            background: #c026d3;
            color: #fff;
            padding: 0.65rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background: #a21caf;
        }

        .btn-cancel {
            background: #f3f4f6;
            color: #374151;
            padding: 0.65rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background: #e5e7eb;
        }

        /* Image preview modal */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.75);
            align-items: center;
            justify-content: center;
            z-index: 10000;
        }


        .modal-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
        }

        .modal-close {
            position: absolute;
            right: -10px;
            top: -10px;
            background: #fff;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            border: none;
            cursor: pointer;
            font-weight: 700;
        }

        .modal-image {
            display: block;
            max-width: 100%;
            max-height: 90vh;
            border-radius: 8px;
            background: #fff;
        }

        .modal-error {
            display: none;
            color: #fff;
            text-align: center;
            padding: 2rem 1rem 1rem 1rem;
            font-size: 1.2rem;
        }

        /* Mobile */
        .doctor-flex-container {
            display: flex;
            gap: 3rem;
            align-items: flex-start;
            margin-bottom: 2rem;
        }

        .doctor-left-part {
            flex: 1;
        }

        .doctor-right-part {
            display: flex;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .stat-box {
            background: #fff;
            border-radius: 1.25rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
            padding: 1.75rem;
            min-width: 200px;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 1.25rem;
            transition: all 0.3s ease;
        }

        .stat-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 32px rgba(15, 23, 42, 0.12);
        }

        .stat-box-icon {
            font-size: 2.5rem;
        }

        .stat-box-info {
            flex: 1;
        }

        .stat-box-number {
            font-size: 2rem;
            font-weight: 900;
            color: #c026d3;
        }

        .stat-box-label {
            font-size: 0.9rem;
            color: #6b7280;
        }

        @media (max-width: 768px) {
            .doctor-flex-container {
                flex-direction: column;
                gap: 1.5rem;
            }

            .doctor-left-part {
                order: 2;
            }

            .doctor-right-part {
                order: 1;
                gap: 1rem;
            }

            .stat-box {
                flex: 1;
                min-width: auto;
                padding: 1.5rem 1rem;
            }

            .stat-box-icon {
                font-size: 2rem;
            }

            .stat-box-number {
                font-size: 1.5rem;
            }

            .stat-box-label {
                font-size: 0.85rem;
            }

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

            .welcome-title {
                font-size: 1.75rem;
                padding-right: 120px;
            }

            .welcome-subtitle {
                font-size: 0.9rem;
            }

            .doctor-dashboard {
                padding-bottom: 2rem;
            }


            .section-title {
                font-size: 1.5rem;
                margin-bottom: 0.75rem;
            }

            .add-exam-btn {
                padding: 0.65rem 1rem;
                font-size: 0.9rem;
                width: 100%;
            }

            .exam-table-wrapper {
                border-radius: 0.75rem;
                box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
            }

            .exam-table {
                font-size: 0.85rem;
            }

            .exam-table th {
                padding: 0.75rem 0.5rem;
                font-size: 0.75rem;
            }

            .exam-table td {
                padding: 0.75rem 0.5rem;
                font-size: 0.85rem;
            }

            .exam-actions {
                flex-direction: column;
                gap: 0.25rem;
            }


            .btn-view, .btn-edit, .btn-delete {
                padding: 0.35rem 0.5rem;
                font-size: 0.7rem;
                width: 100%;
            }

            .exam-date {
                font-weight: 600;
                font-size: 0.85rem;
            }

            .modal-content-box {
                width: 95%;
                max-width: 100%;
                padding: 1rem;
            }

            .modal-content-box h3 {
                font-size: 1.1rem;
            }

            .form-group input,
            .form-group select {
                padding: 0.6rem;
                font-size: 0.9rem;
            }

            .modal-actions {
                gap: 0.5rem;
            }

            .btn-save, .btn-cancel {
                padding: 0.5rem 1rem;
                font-size: 0.85rem;
                flex: 1;
            }

            .stat-icon {
                font-size: 1.75rem;
            }

            .stat-number {
                font-size: 1.5rem;
            }

            .stat-label {
                font-size: 0.8rem;
            }

            .container {
                padding-inline: 0.75rem;
            }
        }

        /* Extra small devices */
        @media (max-width: 480px) {
            .welcome-title {
                font-size: 1.75rem;
            }

            .welcome-subtitle {
                font-size: 0.9rem;
            }

            .section-title {
                font-size: 1.25rem;
            }

            .add-exam-btn {
                font-size: 0.85rem;
                padding: 0.5rem 0.75rem;
            }

            .exam-table th {
                font-size: 0.7rem;
                padding: 0.5rem 0.25rem;
            }

            .exam-table td {
                padding: 0.5rem 0.25rem;
                font-size: 0.75rem;
            }

            .btn-view, .btn-edit, .btn-delete {
                padding: 0.3rem 0.4rem;
                font-size: 0.65rem;
            }

            .modal-content-box {
                padding: 0.75rem;
            }

            .form-group label {
                font-size: 0.85rem;
            }

            .form-group input,
            .form-group select {
                padding: 0.5rem;
                font-size: 0.85rem;
            }
        }
    </style>
</head>

<body>

<section class="welcome-hero">
    <div class="container">
        <div class="welcome-content">
            <h1 class="welcome-title">Vitajte, <span id="welcomeName">doktor</span></h1>
            <p class="welcome-subtitle">
                Správa vašich vyšetrení a pacientov
            </p>
        </div>
        <button id="logoutBtn" class="hero-logout">Odhlásiť sa</button>
    </div>
</section>

<div class="container">
    <section class="doctor-dashboard">
        <!-- Flex kontainer: Ľavo nadpis+tlačidlo, Vpravo štatistiky -->
        <div class="doctor-flex-container">

            <!-- ĽAVÁ ČASŤ: Nadpis a Tlačidlo pod sebou -->
            <div class="doctor-left-part">
                <h2 class="section-title" style="margin-bottom: 1rem;">Moje vyšetrenia</h2>
                <button class="add-exam-btn" onclick="openExamModalForPatientPrompt()">+ Nahrať nové vyšetrenie</button>
            </div>

            <!-- PRAVÁ ČASŤ: Štatistiky vedľa seba v JEDNOM RIADKU -->
            <div class="doctor-right-part">
                <!-- Štatistika: Dnes -->
                <div class="stat-box">
                    <div class="stat-box-icon">📅</div>
                    <div class="stat-box-info">
                        <div class="stat-box-number" id="examsTodayCount">0</div>
                        <div class="stat-box-label">Vyšetrenia dnes</div>
                    </div>
                </div>

                <!-- Štatistika: Celkom -->
                <div class="stat-box">
                    <div class="stat-box-icon">📊</div>
                    <div class="stat-box-info">
                        <div class="stat-box-number" id="examsTotalCount">0</div>
                        <div class="stat-box-label">Celkovo vyšetrení</div>
                    </div>
                </div>
            </div>

        </div>

        <!-- TABUĽKA v osobitnom kontajneri -->
        <div class="exam-table-wrapper" style="background: #fff; border-radius: 1.25rem; box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06); overflow: hidden;">
            <div class="table-wrapper">
                <table class="exam-table">
                    <thead>
                        <tr>
                            <th>Dátum</th>
                            <th>Pacient</th>
                            <th>Nález</th>
                            <th>Akcie</th>
                        </tr>
                    </thead>
                    <tbody id="examTableBody">
                        <tr>
                            <td colspan="4" class="no-exams">Načítavam vyšetrenia...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</div>

<!-- Add Examination Modal -->
<div id="addExamModal" class="modal-dialog">
    <div class="modal-content-box">
        <h3>Nahrať nové vyšetrenie</h3>

        <div class="form-group">
            <label>ID Pacienta: *</label>
            <input type="number" id="newExamPatientId" placeholder="Zadajte ID pacienta" min="1">
            <div id="patientValidation" style="margin-top: 0.5rem; font-size: 0.85rem;"></div>
        </div>

        <div class="form-group">
            <label>Pacient:</label>
            <input type="text" id="patientNameDisplay" disabled style="background:#f3f4f6;cursor:not-allowed;" placeholder="Overí sa po zadaní ID">
        </div>

        <div class="form-group">
            <label>Fotka mamogramu: *</label>
            <input type="file" id="newExamPhoto" accept="image/*">
        </div>

        <div class="form-group">
            <label>Nález: *</label>
            <select id="newExamResult">
                <option value="negative">Negatívny</option>
                <option value="positive">Pozitívny</option>
            </select>
        </div>

        <div class="form-group">
            <label>Poznámky: (voliteľné)</label>
            <textarea id="newExamNotes" rows="3" placeholder="Poznámky k vyšetreniu..."></textarea>
        </div>

        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeAddExamModal()">Zrušiť</button>
            <button class="btn-save" id="saveExamBtn" disabled>Uložiť vyšetrenie</button>
        </div>
    </div>
</div>

<!-- Image preview modal -->
<div id="imageModal" class="modal">
    <div class="modal-content">
        <button id="imageModalClose" class="modal-close">✕</button>
        <img id="imageModalImg" class="modal-image" src="" alt="Prehliadanie vyšetrenia" />
        <div id="imageModalError" class="modal-error">Fotku sa nepodarilo načítať.<br>Skontrolujte, či bola správne nahraná a je dostupná na serveri.</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="/js/doktor.js"></script>

</body>
</html>
