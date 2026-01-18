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

            /* Make hero logout flow naturally on mobile (no absolute overlap) */
            .hero-logout {
                position: static;
                margin: 0.5rem 0 0 auto;
                display: inline-block;
                transform: none;
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
            <!-- Navigation hidden for patient; only logout button shown as requested -->
        </div>

        <!-- logout moved into welcome hero for better visual placement -->
     </div>
 </header>

 <section class="welcome-hero">
     <div class="container">
        <div class="welcome-content">
            <h1 class="welcome-title">Vitajte, <span id="welcomeName">pacient</span></h1>
            <p class="welcome-subtitle">
                Tu nájdete prístup k vašim vyšetreniam a zdravotným záznamom
            </p>
        </div>
        <!-- Logout button inside the purple hero, visually aligned to top-right -->
        <button id="logoutBtn" class="hero-logout">Odhlásiť sa</button>
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

<!-- Image preview modal -->
<div id="imageModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.75);align-items:center;justify-content:center;z-index:10000;">
    <div style="position:relative;max-width:90%;max-height:90%;">
        <button id="imageModalClose" style="position:absolute;right:-10px;top:-10px;background:#fff;border-radius:50%;width:36px;height:36px;border:none;cursor:pointer;font-weight:700;">✕</button>
        <img id="imageModalImg" src="" alt="Prehliadanie vyšetrenia" style="display:block;max-width:100%;max-height:90vh;border-radius:8px;" />
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // modal helpers
    function showImageModal(url) {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('imageModalImg');
        if (!modal || !img) return;
        img.src = url;
        modal.style.display = 'flex';
    }
    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        const img = document.getElementById('imageModalImg');
        if (!modal || !img) return;
        modal.style.display = 'none';
        img.src = '';
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
        // send cookies for sanctum stateful auth by default
        axios.defaults.withCredentials = true;
    }

    // Ensure the welcome name is updated correctly
    const welcomeEl = document.getElementById('welcomeName');
    if (welcomeEl) welcomeEl.innerText = me.name || me.email || 'Pacient';

    // Fix logout button functionality
    async function handleLogout() {
        try {
            await axios.post('/logout');
            localStorage.removeItem('userToken');
            localStorage.removeItem('user');
            window.location.href = '/login';
        } catch (err) {
            console.error('Chyba pri odhlásení', err);
            alert('Nepodarilo sa odhlásiť. Skúste to znova.');
        }
    }

    // Attach logout event listener
    const logoutBtn = document.getElementById('logoutBtn');
    if (logoutBtn) {
        logoutBtn.addEventListener('click', handleLogout);
    }

    async function loadPatientExams() {
        try {
            // Ensure Authorization header is set from stored token before calling /user
            const token = localStorage.getItem('userToken');
            if (token && typeof axios !== 'undefined') {
                axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            } else {
                // remove Authorization header if no token
                if (axios.defaults && axios.defaults.headers && axios.defaults.headers.common) delete axios.defaults.headers.common['Authorization'];
            }

            // get current user (works with sanctum/session or token)
            let me = null;
            try {
                const meResp = await axios.get('/user');
                // support both shapes: {id,name,...} or {user: {...}}
                me = meResp && meResp.data ? (meResp.data.user ? meResp.data.user : meResp.data) : null;
            } catch (err) {
                // fallback: try to read user from localStorage (set during API login)
                try {
                    const local = localStorage.getItem('user');
                    me = local ? JSON.parse(local) : null;
                } catch (e) {
                    me = null;
                }
            }

            if (!me || !me.id) {
                console.warn('Cannot determine current user for fetching exams.');
                const listEl = document.querySelector('.exam-list');
                if (listEl) listEl.innerHTML = '<div class="exam-item">Nie je prihlásený používateľ.</div>';
                return;
            }

            // set welcome name
            const welcomeEl = document.getElementById('welcomeName');
            if (welcomeEl) welcomeEl.innerText = me.name || me.email || 'Pacient';

            const res = await axios.get(`/patients/${me.id}/examinations`);
            const exams = res && res.data ? res.data : [];
            const list = document.querySelector('.exam-list');
            if (!list) return;
            if (!exams || exams.length === 0) {
                list.innerHTML = '<div class="exam-item">Žiadne vyšetrenia.</div>';
                return;
            }
            list.innerHTML = exams.map(e => {
                // robust date parse: convert space to T for ISO, fallback to raw
                let date = '';
                if (e.created_at) {
                    try {
                        const iso = String(e.created_at).replace(' ', 'T');
                        const dt = new Date(iso);
                        if (!isNaN(dt)) date = dt.toLocaleString('sk-SK', { dateStyle: 'short', timeStyle: 'short' });
                        else date = e.created_at;
                    } catch (ex) { date = e.created_at; }
                }
                const doctorName = e.doctor ? (e.doctor.name + ' ' + (e.doctor.surname || '')) : 'Neznámy';
                const photoHtml = e.photo_url ? `<img src="${e.photo_url}" style="width:100%;height:100%;object-fit:cover;" alt="Vyšetrenie #${e.id}" />` : `<div style="width:100%;height:100%;background:#f3f4f6;display:flex;align-items:center;justify-content:center;color:#9ca3af">No image</div>`;
                const viewHref = e.photo_url ? e.photo_url : '#';
                return `
                <div class="exam-item">
                    <div style="width:96px;height:64px;overflow:hidden;border-radius:8px;">${photoHtml}</div>
                    <div class="exam-info">
                        <div class="exam-date">${date}</div>
                        <h4 class="exam-name">Vyšetrenie #${e.id}</h4>
                        <p class="exam-status ${e.result === 'positive' ? 'status-completed' : 'status-completed'}">${e.result ? e.result : 'N/A'}</p>
                        <div style="font-size:0.9rem;color:#6b7280;margin-top:6px;">Doktor: ${doctorName}</div>
                    </div>
                    <a class="exam-link" href="${viewHref}" data-photo="${viewHref}" class="view-photo">Zobraziť</a>
                </div>
            `;
            }).join('');

            // attach delegated click handler to open images reliably (works on mobile)
            document.querySelectorAll('.exam-list .exam-link').forEach(a => {
                a.addEventListener('click', function (ev) {
                    const url = this.getAttribute('data-photo');
                    if (!url || url === '#') {
                        ev.preventDefault();
                        alert('Fotka pre toto vyšetrenie nie je dostupná.');
                        return;
                    }
                    // Open the modal with the image
                    showImageModal(url);
                    ev.preventDefault();
                });
            });
         } catch (err) {
             console.error('Chyba pri načítaní vyšetrení', err);
         }
     }

     loadPatientExams();
</script>

</body>
</html>
