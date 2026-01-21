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
        }

        /* Welcome Hero */
        .welcome-hero {
            background: linear-gradient(135deg, #9c0b8e 0%, #d04fa7 100%);
            padding: 3rem 0;
            margin-bottom: 3rem;
            position: relative; /* allow absolute children */
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
            border: none;
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
            grid-template-columns: 1fr auto;
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

        .status-positive {
            background: #d1fae5;
            color: #065f46;
        }

        .status-negative {
            background: #fee2e2;
            color: #b91c1c;
        }

        .status-unknown {
            background: #f3f4f6;
            color: #6b7280;
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

        .exam-notes {
            font-size: 0.85rem;
            color: #374151;
            margin-top: 6px;
            font-style: normal;
            display: block;
        }

        /* Mobile */
        @media (max-width: 768px) {
            .exam-notes {
                max-width: 250px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }
        }
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

            .welcome-title {
                font-size: 1.75rem;
                padding-right: 120px;
            }

            .welcome-subtitle {
                font-size: 0.9rem;
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

<section class="welcome-hero">
    <div class="container">
        <div class="welcome-content">
            <h1 class="welcome-title">Vitajte, <span id="welcomeName">pacient</span></h1>
            <p class="welcome-subtitle">
                Tu nájdete prístup k vašim vyšetreniam a zdravotným záznamom
            </p>
        </div>
        <button id="logoutBtn" class="hero-logout">Odhlásiť sa</button>
    </div>
</section>

<div class="container">
    <section class="patient-dashboard">
        <div class="recent-section">
            <h2 class="section-title">Nedávne vyšetrenia</h2>
            <div class="exam-list" id="examList">
                <div class="exam-item">Načítavam vyšetrenia...</div>
            </div>
        </div>
    </section>
</div>

<!-- Image preview modal -->
<div id="imageModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.75);align-items:center;justify-content:center;z-index:10000;">
    <div style="position:relative;max-width:90%;max-height:90%;">
        <button id="imageModalClose" style="position:absolute;right:-10px;top:-10px;background:#fff;border-radius:50%;width:36px;height:36px;border:none;cursor:pointer;font-weight:700;">✕</button>
        <img id="imageModalImg" src="" alt="Prehliadanie vyšetrenia" style="display:block;max-width:100%;max-height:90vh;border-radius:8px;background:#fff;" onerror="this.style.display='none';document.getElementById('imageModalError').style.display='block';" />
        <div id="imageModalError" style="display:none;color:#fff;text-align:center;padding:2rem 1rem 1rem 1rem;font-size:1.2rem;">Fotku sa nepodarilo načítať.<br>Skontrolujte, či bola správne nahraná a je dostupná na serveri.</div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="/js/pacient.js"></script>

</body>
</html>

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
        // Debug: vypíš URL do konzoly
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

    const API_URL = "{{ url('/api') }}";
    if (typeof axios !== 'undefined') {
        axios.defaults.baseURL = API_URL;
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios.defaults.headers.common['Accept'] = 'application/json';
        // send cookies for sanctum/stateful auth by default
        axios.defaults.withCredentials = true;
    }

    // Logout button - use token if present, otherwise rely on cookie session
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

    // Load user and exams
    async function loadPatientData() {
        let user = null;
        try {
            // If we have a token, set Authorization header for axios requests
            const token = localStorage.getItem('userToken');
            if (token) {
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            } else {
                delete axios.defaults.headers.common['Authorization'];
            }

            // Get user; backend may return { user: {...} } or just {...}
            const resp = await axios.get('/user');
            const respData = resp && resp.data ? resp.data : null;
            user = respData && respData.user ? respData.user : respData;
            // Ensure user is an object
            if (!user || typeof user !== 'object') {
                throw new Error('No user data returned');
            }
            const displayName = (user.name || user.email || 'Pacient');
            const welcomeEl = document.getElementById('welcomeName');
            if (welcomeEl) welcomeEl.innerText = displayName;
        } catch (err) {
            console.warn('Could not load user data:', err);
            const welcomeEl = document.getElementById('welcomeName');
            if (welcomeEl) welcomeEl.innerText = 'Pacient';
            document.getElementById('examList').innerHTML = '<div class="exam-item">Chyba: nie ste prihlásený.</div>';
            return;
        }
        // Get exams for the user
        try {
            const examsResp = await axios.get(`/patients/${user.id}/examinations`);
            const exams = examsResp && examsResp.data ? examsResp.data : [];
            if (!exams || exams.length === 0) {
                document.getElementById('examList').innerHTML = '<div class="exam-item">Žiadne vyšetrenia.</div>';
                return;
            }
            document.getElementById('examList').innerHTML = exams.map(e => {
                const date = e.created_at ? new Date(e.created_at.replace(' ', 'T')).toLocaleDateString('sk-SK') : '';
                const doctorName = e.doctor ? (e.doctor.name || '') : '';
                const doctorSurname = e.doctor ? (e.doctor.surname || '') : '';
                const doctorFull = [doctorName, doctorSurname].filter(x => x).join(' ') || 'Neznámy';
                let statusClass = '';
                if (e.result === 'positive') statusClass = 'status-positive';
                else if (e.result === 'negative') statusClass = 'status-negative';
                else statusClass = 'status-unknown';
                // Ensure photo_url field is safe string
                const photoVal = e.photo_url || e.photo || '';
                const notes = e.notes || '';

                return `
                <div class="exam-item">
                    <div class="exam-info">
                        <div class="exam-date">${date}</div>
                        <h4 class="exam-name">Vyšetrenie #${e.id}</h4>
                        <p class="exam-status ${statusClass}">${e.result ? e.result : 'N/A'}</p>
                        <div style="font-size:0.9rem;color:#6b7280;margin-top:6px;">Doktor: ${doctorFull}</div>
                        ${notes ? `<div class="exam-notes">Poznámka: ${notes}</div>` : ''}
                    </div>
                    <a class="exam-link" href="#" data-photo="${photoVal}">Zobraziť</a>
                </div>
                `;
            }).join('');

            // Attach click handlers for modal (normalize different saved path shapes)
            document.querySelectorAll('.exam-link').forEach(a => {
                a.onclick = function(ev) {
                    ev.preventDefault();
                    let url = this.getAttribute('data-photo') || '';
                    console.log('raw photo url from data attribute:', url);
                    if (!url) {
                        alert('Fotka nie je dostupná.');
                        return;
                    }

                    try {
                        // Absolute external URL -> convert to same-origin path (use pathname)
                        if (url.startsWith('http://') || url.startsWith('https://')) {
                            const parsed = new URL(url);
                            if (parsed.origin !== window.location.origin) {
                                url = window.location.origin + parsed.pathname + (parsed.search || '');
                            } else {
                                url = parsed.href;
                            }
                        }
                        // Origin-relative path (starts with '/')
                        else if (url.startsWith('/')) {
                            url = window.location.origin + url;
                        }
                        // Bare path (e.g. "photos/xxx.png" or "storage/photos/xxx.png")
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

        } catch (err) {
            console.error('Error loading exams:', err);
            document.getElementById('examList').innerHTML = '<div class="exam-item">Chyba pri načítaní vyšetrení.</div>';
        }
    }

    // Ensure data loads when page opens
    loadPatientData();
</script>

</body>
</html>
