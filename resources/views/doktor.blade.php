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

        axios.defaults.baseURL = API_URL;
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['Accept'] = 'application/json';
        axios.defaults.withCredentials = true;
    }

    // Modal helpers - rovnaké ako u pacienta
    function showImageModal(url) {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('imageModalImg');
        const err = document.getElementById('imageModalError');
        if (!modal || !img || !err) return;
        if (!url) {
            img.style.display = 'none';
            err.style.display = 'block';
            modal.style.display = 'flex';
            return;
        }
        img.src = url;
        img.style.display = 'block';
        err.style.display = 'none';
        modal.style.display = 'flex';
        console.log('Zobrazujem fotku:', url);
    }

    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('imageModalImg');
        const err = document.getElementById('imageModalError');
        if (!modal || !img || !err) return;
        modal.style.display = 'none';
        img.src = '';
        err.style.display = 'none';
    }

    document.addEventListener('click', function (ev) {
        if (ev.target && ev.target.id === 'imageModalClose') {
            closeImageModal();
        }
        // close when clicking outside the image
        if (ev.target && ev.target.id === 'imageModal') {
            closeImageModal();
        }
    });

    // Logout button
    document.getElementById('logoutBtn').onclick = async function() {
        try {
            const token = localStorage.getItem('userToken');
            const headers = token ? { 'Authorization': `Bearer ${token}` } : {};
            await axios.post('/logout', {}, { headers });
        } catch (e) {
            console.warn('Logout request failed (continuing to clear local state)', e);
        } finally {
            localStorage.removeItem('userToken');
            localStorage.removeItem('user');
            window.location.href = '/prihlasenie';
        }
    };

    // Load doctor data and exams
    async function loadDoctorData() {
        let doctor = null;
        try {
            const token = localStorage.getItem('userToken');
            if (token) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            } else {
                delete axios.defaults.headers.common['Authorization'];
            }

            const resp = await axios.get('/user');
            const respData = resp && resp.data ? resp.data : null;
            doctor = respData && respData.user ? respData.user : respData;

            if (!doctor || typeof doctor !== 'object') {
                throw new Error('No user data returned');
            }

            const displayName = (doctor.name || doctor.email || 'Doktor');
            const welcomeEl = document.getElementById('welcomeName');
            if (welcomeEl) welcomeEl.innerText = displayName;

        } catch (err) {
            console.warn('Could not load user data:', err);
            const welcomeEl = document.getElementById('welcomeName');
            if (welcomeEl) welcomeEl.innerText = 'Doktor';
            document.getElementById('examTableBody').innerHTML = '<tr><td colspan="4" class="no-exams">Chyba: nie ste prihlásený.</td></tr>';
            return;
        }

        // Load exams for the doctor
        try {
            const examsResp = await axios.get(`/doctors/${doctor.id}/examinations`);
            const exams = examsResp && examsResp.data ? examsResp.data : [];

            // Výpočet štatistík
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            let examsTodayCount = 0;
            let examsTotalCount = exams.length;

            exams.forEach(e => {
                if (e.created_at) {
                    const examDate = new Date(e.created_at.replace(' ', 'T'));
                    const examDateOnly = new Date(examDate.getFullYear(), examDate.getMonth(), examDate.getDate());
                    if (examDateOnly.getTime() === today.getTime()) {
                        examsTodayCount++;
                    }
                }
            });

            // Aktualizácia štatistík
            const todayEl = document.getElementById('examsTodayCount');
            const totalEl = document.getElementById('examsTotalCount');
            if (todayEl) todayEl.innerText = examsTodayCount;
            if (totalEl) totalEl.innerText = examsTotalCount;

            if (!exams || exams.length === 0) {
                document.getElementById('examTableBody').innerHTML = '<tr><td colspan="4" class="no-exams">Žiadne vyšetrenia.</td></tr>';
                return;
            }

            document.getElementById('examTableBody').innerHTML = exams.map(e => {
                const date = e.created_at ? new Date(e.created_at.replace(' ', 'T')).toLocaleDateString('sk-SK') : '';
                const patientName = e.patient ? (e.patient.name || 'Pacient') : 'Neznámy';

                let statusClass = '';
                let statusText = e.result ? e.result : 'N/A';
                if (e.result === 'positive') statusClass = 'status-positive';
                else if (e.result === 'negative') statusClass = 'status-negative';
                else statusClass = 'status-unknown';

                const photoUrl = e.photo_url || '';

                return `
                <tr>
                    <td class="exam-date">${date}</td>
                    <td>${patientName}</td>
                    <td><span class="exam-status ${statusClass}">${statusText}</span></td>
                    <td>
                        <div class="exam-actions">
                            ${photoUrl ? `<button class="btn-view" data-photo="${photoUrl}">Zobraziť</button>` : ''}
                            <button class="btn-edit" data-exam-id="${e.id}">Upraviť</button>
                            <button class="btn-delete" data-exam-id="${e.id}">Zmazať</button>
                        </div>
                    </td>
                </tr>
                `;
            }).join('');

            // Attach click handlers pre Zobraziť tlačidlá
            document.querySelectorAll('.btn-view').forEach(btn => {
                btn.onclick = function(ev) {
                    ev.preventDefault();
                    let url = this.getAttribute('data-photo') || '';
                    console.log('raw photo url:', url);
                    if (!url) {
                        alert('Fotka nie je dostupná.');
                        return;
                    }

                    try {
                        // Absolute external URL -> convert to same-origin path
                        if (url.startsWith('http://') || url.startsWith('https://')) {
                            const parsed = new URL(url);
                            if (parsed.origin !== window.location.origin) {
                                url = window.location.origin + parsed.pathname + (parsed.search || '');
                            } else {
                                url = parsed.href;
                            }
                        }
                        // Origin-relative path
                        else if (url.startsWith('/')) {
                            url = window.location.origin + url;
                        }
                        // Bare path
                        else {
                            if (url.startsWith('storage/')) {
                                url = window.location.origin + '/' + url;
                            } else {
                                url = window.location.origin + '/storage/' + url.replace(/^\/+/, '');
                            }
                        }

                        showImageModal(url);
                    } catch (err) {
                        console.error('Error preparing image URL', err);
                        alert('Chyba pri otváraní fotky.');
                    }
                };
            });

            // Attach click handlers pre Upraviť tlačidlá
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.onclick = function() {
                    const examId = this.getAttribute('data-exam-id');
                    openExamEditor(examId);
                };
            });

            // Attach click handlers pre Zmazať tlačidlá
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.onclick = function() {
                    const examId = this.getAttribute('data-exam-id');
                    deleteExam(examId);
                };
            });

        } catch (err) {
            console.error('Error loading exams:', err);
            document.getElementById('examTableBody').innerHTML = '<tr><td colspan="4" class="no-exams">Chyba pri načítaní vyšetrení.</td></tr>';
        }
    }

    function openExamModalForPatientPrompt() {
        const modal = document.getElementById('addExamModal');
        if (!modal) return;

        // Reset form
        document.getElementById('newExamPatientId').value = '';
        document.getElementById('patientNameDisplay').value = '';
        document.getElementById('newExamPhoto').value = '';
        document.getElementById('newExamResult').value = 'negative';
        document.getElementById('newExamNotes').value = '';
        document.getElementById('patientValidation').innerHTML = '';
        document.getElementById('saveExamBtn').disabled = true;

        modal.style.display = 'flex';
    }

    function closeAddExamModal() {
        const modal = document.getElementById('addExamModal');
        if (modal) modal.style.display = 'none';
    }

    // AJAX overenie pacienta
    let patientCheckTimeout = null;
    document.addEventListener('DOMContentLoaded', function() {
        const patientIdInput = document.getElementById('newExamPatientId');
        const patientNameDisplay = document.getElementById('patientNameDisplay');
        const patientValidation = document.getElementById('patientValidation');
        const saveBtn = document.getElementById('saveExamBtn');

        if (patientIdInput) {
            patientIdInput.addEventListener('input', function() {
                const patientId = this.value.trim();

                // Clear previous validation
                patientValidation.innerHTML = '';
                patientNameDisplay.value = '';
                saveBtn.disabled = true;

                // Clear previous timeout
                if (patientCheckTimeout) clearTimeout(patientCheckTimeout);

                if (!patientId || patientId < 1) {
                    return;
                }

                // Show loading
                patientValidation.innerHTML = '<span style="color:#6b7280;">🔍 Overujem pacienta...</span>';

                // Debounce - čakaj 500ms pred overením
                patientCheckTimeout = setTimeout(async () => {
                    try {
                        const token = localStorage.getItem('userToken');
                        const headers = token ? { 'Authorization': `Bearer ${token}` } : {};

                        // Pokús sa načítať používateľa
                        const response = await axios.get(`/users/${patientId}`, { headers });
                        const user = response.data;

                        // Skontroluj či je to pacient
                        if (user && user.role === 'patient') {
                            patientValidation.innerHTML = '<span style="color:#065f46;">✓ Pacient existuje</span>';
                            patientNameDisplay.value = user.name + (user.surname ? ' ' + user.surname : '');
                            saveBtn.disabled = false;
                        } else if (user && user.role !== 'patient') {
                            patientValidation.innerHTML = '<span style="color:#991b1b;">✗ Toto ID nepatrí pacientovi (rola: ' + user.role + ')</span>';
                            saveBtn.disabled = true;
                        } else {
                            patientValidation.innerHTML = '<span style="color:#991b1b;">✗ Pacient nenájdený</span>';
                            saveBtn.disabled = true;
                        }
                    } catch (error) {
                        if (error.response && error.response.status === 404) {
                            patientValidation.innerHTML = '<span style="color:#991b1b;">✗ Pacient s týmto ID neexistuje</span>';
                        } else {
                            patientValidation.innerHTML = '<span style="color:#991b1b;">✗ Chyba pri overovaní</span>';
                            console.error('Patient validation error:', error);
                        }
                        saveBtn.disabled = true;
                    }
                }, 500);
            });
        }

        // Save button handler
        if (saveBtn) {
            saveBtn.addEventListener('click', async function() {
                const patientId = document.getElementById('newExamPatientId').value;
                const photoInput = document.getElementById('newExamPhoto');
                const result = document.getElementById('newExamResult').value;
                const notes = document.getElementById('newExamNotes').value;

                if (!patientId || !photoInput.files[0]) {
                    alert('Vyplňte všetky povinné polia (ID pacienta a fotka)');
                    return;
                }

                const fd = new FormData();
                fd.append('patient_id', patientId);
                fd.append('photo', photoInput.files[0]);
                fd.append('result', result);
                if (notes) fd.append('notes', notes);

                try {
                    this.disabled = true;
                    this.innerText = 'Ukladám...';

                    const token = localStorage.getItem('userToken');
                    const headers = token ? { 'Authorization': `Bearer ${token}` } : {};
                    await axios.post('/examinations', fd, { headers });

                    alert('Vyšetrenie úspešne uložené');
                    closeAddExamModal();
                    loadDoctorData();
                } catch (err) {
                    console.error('Upload error', err);
                    alert('Chyba pri nahrávaní vyšetrenia: ' + (err.response?.data?.message || err.message));
                    this.disabled = false;
                    this.innerText = 'Uložiť vyšetrenie';
                }
            });
        }

        // Close modal on background click
        const addExamModal = document.getElementById('addExamModal');
        if (addExamModal) {
            addExamModal.addEventListener('click', function(e) {
                if (e.target === this) closeAddExamModal();
            });
        }
    });

    function openExamEditor(examId) {
        (async function () {
            try {
                const res = await axios.get(`/examinations/${examId}`);
                const exam = res.data;

                const createdDate = exam.created_at ? new Date(exam.created_at.replace(' ', 'T')).toISOString().split('T')[0] : new Date().toISOString().split('T')[0];
                const patientName = exam.patient ? (exam.patient.name || 'Pacient') : 'Neznámy';

                // Create modal
                const modal = document.createElement('div');
                modal.className = 'modal-dialog active';
                modal.innerHTML = `
                    <div class="modal-content-box">
                        <h3>Upraviť vyšetrenie #${exam.id}</h3>

                        <div class="form-group">
                            <label>ID Pacienta:</label>
                            <input type="text" value="${exam.patient_id}" disabled style="background:#f3f4f6;cursor:not-allowed;">
                        </div>

                        <div class="form-group">
                            <label>Pacient:</label>
                            <input type="text" value="${patientName}" disabled style="background:#f3f4f6;cursor:not-allowed;">
                        </div>

                        <div class="form-group">
                            <label>Dátum vyšetrenia:</label>
                            <input type="date" id="editDate" value="${createdDate}">
                        </div>

                        <div class="form-group">
                            <label>Nález:</label>
                            <select id="editResult">
                                <option value="positive" ${exam.result === 'positive' ? 'selected' : ''}>Pozitívny</option>
                                <option value="negative" ${exam.result === 'negative' ? 'selected' : ''}>Negatívny</option>
                            </select>
                        </div>


                        <div class="modal-actions">
                            <button class="btn-cancel" onclick="this.closest('.modal-dialog').remove()">Zrušiť</button>
                            <button class="btn-save" onclick="saveExamChanges(${exam.id})">Uložiť zmeny</button>
                        </div>
                    </div>
                `;

                document.body.appendChild(modal);

                // Close on background click
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) modal.remove();
                });

                // Store exam data globally for saving
                window.currentExamEdit = {
                    examId: exam.id,
                    modal: modal
                };

            } catch (err) {
                console.error(err);
                alert('Chyba pri načítaní vyšetrenia');
            }
        })();
    }

    async function saveExamChanges(examId) {
        try {
            const dateInput = document.getElementById('editDate');
            const resultSelect = document.getElementById('editResult');

            const newDate = dateInput.value;
            const newResult = resultSelect.value;

            const fd = new FormData();
            fd.append('_method', 'PUT');
            fd.append('result', newResult);
            if (newDate) fd.append('created_at', newDate + ' 00:00:00');

            const token = localStorage.getItem('userToken');
            const headers = token ? { 'Authorization': `Bearer ${token}` } : {};

            await axios.post(`/examinations/${examId}`, fd, { headers });

            alert('Vyšetrenie úspešne aktualizované');

            // Close modal
            if (window.currentExamEdit && window.currentExamEdit.modal) {
                window.currentExamEdit.modal.remove();
            }

            loadDoctorData();
        } catch (err) {
            console.error('Save error:', err.response?.data || err.message);
            alert('Chyba pri aktualizácii vyšetrenia: ' + (err.response?.data?.message || err.message));
        }
    }

    async function deleteExam(examId) {
        if (!confirm('Naozaj chcete zmazať toto vyšetrenie?')) return;

        try {
            const token = localStorage.getItem('userToken');
            const headers = token ? { 'Authorization': `Bearer ${token}` } : {};
            await axios.delete(`/examinations/${examId}`, { headers });
            alert('Vyšetrenie zmazané');
            loadDoctorData();
        } catch (err) {
            console.error('Delete error:', err.response?.data || err.message);
            alert('Chyba pri mazaní vyšetrenia: ' + (err.response?.data?.message || err.message));
        }
    }

    loadDoctorData();
</script>

<script src="/js/doktor.js"></script>

</body>
</html>
