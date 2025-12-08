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
            margin-top: 0.6rem; /* small gap above the purple header */
            padding-block: 0.5rem 1rem;
            /* make header match the purple welcome hero */
            background: linear-gradient(135deg, #9c0b8e 0%, #d04fa7 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            position: relative;
        }

        .nav {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
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
            color: #fff; /* links in header should be white on purple */
            font-size: 0.95rem;
            font-weight: 500;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        .btn-primary {
            position: absolute;
            right: clamp(1.5rem, 4vw, 3rem);
            top: 1.6rem;
            transform: none;
            /* white button with purple text */
            background: #ffffff;
            color: #9c0b8e !important; /* purple text */
            padding: 0.55rem 1.6rem;
            border-radius: 999px;
            font-size: 0.95rem;
            font-weight: 600;
            white-space: nowrap;
            cursor: pointer;
            border: 2px solid rgba(0,0,0,0.05);
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        }

        .btn-primary:hover {
            background: #fff;
            color: #7a0a6f !important;
            transform: scale(1.02);
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
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

        /* Header-centered title (fallback) */
        .header-center {
            text-align: center;
            padding: 0.5rem 0 1rem 0;
            color: #fff;
            position: relative;
            z-index: 50; /* ensure it sits above other elements */
            text-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }

        .header-title {
            margin: 0;
            font-size: 2rem;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: 0.02em;
        }

        .header-subtitle {
            margin: 0.35rem 0 0 0;
            color: rgba(255,255,255,0.95);
            font-size: 1rem;
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
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>

<header>
    <div class="container nav">


        <button class="btn-primary" onclick="handleLogout()">Odhlásiť sa</button>
    </div>
</header>

<!-- Welcome hero (title + subtitle) -->
<section class="welcome-hero">
    <div class="container">
        <div class="welcome-content">
            <h1 class="welcome-title">Admin Dashboard</h1>
            <p class="welcome-subtitle">Správa doktorov, pacientov a systému</p>
        </div>
    </div>
</section>

<!-- User modal -->
<div id="userModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); align-items:center; justify-content:center; z-index:9999;">
    <div style="background:#fff; padding:1.25rem; border-radius:8px; width:520px; max-width:95%;">
        <h3 id="modalTitle">Uprav používateľa</h3>
        <form id="userForm">
            <input type="hidden" name="id" id="userId" />
            <div style="display:flex; gap:8px; margin-bottom:8px;">
                <input placeholder="Meno" name="name" id="userName" style="flex:1; padding:8px;" />
                <input placeholder="Priezvisko" name="surname" id="userSurname" style="flex:1; padding:8px;" />
            </div>
            <div style="display:flex; gap:8px; margin-bottom:8px;">
                <input placeholder="Email" name="email" id="userEmail" style="flex:1; padding:8px;" />
                <input placeholder="Telefón" name="phone" id="userPhone" style="flex:1; padding:8px;" />
            </div>
            <div style="display:flex; gap:8px; margin-bottom:8px;">
                <select id="userRole" name="role" style="padding:8px;">
                    <option value="patient">Pacient</option>
                    <option value="doctor">Doktor</option>
                    <option value="admin">Admin</option>
                </select>
                <input placeholder="Dikter ID" name="dikter_id" id="userDikter" style="flex:1; padding:8px;" />
            </div>

            <div style="display:flex; gap:8px; justify-content:flex-end;">
                <button type="button" onclick="closeUserModal()" style="padding:8px 12px;">Zrušiť</button>
                <button id="saveUserBtn" type="button" onclick="saveUser()" style="background:#9c0b8e;color:#fff;padding:8px 12px;border-radius:6px;border:none;">Uložiť</button>
            </div>
        </form>
    </div>
</div>

<div class="container">
    <section class="admin-dashboard">

        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">👨‍⚕️</div>
                <div class="stat-info">
                    <div class="stat-number">{{ $doctorsCount ?? 0 }}</div>
                    <div class="stat-label">Celkovo doktorov</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-info">
                    <div class="stat-number">{{ $patientsCount ?? 0 }}</div>
                    <div class="stat-label">Celkovo pacientov</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">📊</div>
                <div class="stat-info">
                    <div class="stat-number">{{ $analysesCount ?? 0 }}</div>
                    <div class="stat-label">Vykonaných analýz</div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">✅</div>
                <div class="stat-info">
                    <div class="stat-number">{{ $todayCount ?? 0 }}</div>
                    <div class="stat-label">Dnes vykonaných</div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Doktori</h2>
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
                            <th>Zobraziť</th>
                            <th>Upraviť</th>
                            <th>Vymazať</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($doctors ?? collect() as $doc)
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">{{ strtoupper(substr($doc->name,0,1) . substr($doc->surname ?? '',0,1)) }}</div>
                                    <div class="user-details">
                                        <h4>Dr. {{ $doc->name }} {{ $doc->surname }}</h4>
                                        <p>ID: {{ $doc->dikter_id ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $doc->specialization ?? '-' }}</td>
                            <td>{{ $doc->email }}</td>
                            <td>{{ $doc->phone ?? '-' }}</td>
                            <td><button class="btn-action btn-view" onclick="viewUser({{ $doc->id }})">Zobraziť</button></td>
                            <td><button class="btn-action btn-edit" onclick="openUserModal({{ json_encode($doc) }})">Upraviť</button></td>
                            <td><button class="btn-action btn-delete" onclick="deleteUser({{ $doc->id }})">Vymazať</button></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">Žiadni doktori.</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Pacienti</h2>
            </div>

            <div class="table-container">
                <div class="table-wrapper">
                    <table>
                        <thead>
                        <tr>
                            <th>Pacient</th>
                            <th>Meno</th>
                            <td>Priezvisko</td>
                            <th>Email</th>
                            <th>Telefón</th>
                            <th>Posledné vyšetrenie</th>
                            <th>Zobraziť</th>
                            <th>Upraviť</th>
                            <th>Vymazať</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($patients ?? collect() as $p)
                        <tr>
                            <td>
                                <div class="user-info">
                                    <div class="user-avatar">{{ strtoupper(substr($p->name,0,1) . substr($p->surname ?? '',0,1)) }}</div>
                                    <div class="user-details">
                                    </div>
                                </div>
                            </td>
                            <td>{{ $p->name }}</td>
                            <td>{{ $p->surname }}</td>
                            <td>{{ $p->birth_date ? \Carbon\Carbon::parse($p->birth_date)->age . ' rokov' : '-' }}</td>
                            <td>{{ $p->phone ?? '-' }}</td>
                            <td>{{ $p->last_exam_date ?? '-' }}</td>
                            <td><button class="btn-action btn-view" onclick="viewUser({{ $p->id }})">Zobraziť</button></td>
                            <td><button class="btn-action btn-edit" onclick="openUserModal({{ json_encode($p) }})">Upraviť</button></td>
                            <td><button class="btn-action btn-delete" onclick="deleteUser({{ $p->id }})">Vymazať</button></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">Žiadni pacienti.</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Base API URL for requests
    const API_URL = '{{ url('/') }}';

    // Configure axios default headers
    // Set CSRF token for axios
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (csrfMeta) {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfMeta.getAttribute('content');
    }
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

    async function viewUser(id) {
        try {
            const res = await axios.get(`/admin/users/${id}`);
            openUserModal(res.data, 'view');
        } catch (err) {
            alert('Chyba pri načítaní používateľa');
            console.error(err);
        }
    }

    function openUserModal(user, mode = 'edit') {
        document.getElementById('userId').value = user.id;
        document.getElementById('userName').value = user.name || '';
        document.getElementById('userSurname').value = user.surname || '';
        document.getElementById('userEmail').value = user.email || '';
        document.getElementById('userPhone').value = user.phone || '';

        const saveBtn = document.getElementById('saveUserBtn');
        if (mode === 'view') {
            document.getElementById('modalTitle').innerText = 'Zobraziť používateľa';
            ['userName','userSurname','userEmail','userPhone',].forEach(id => {
                document.getElementById(id).setAttribute('disabled','disabled');
            });
            if (saveBtn) saveBtn.style.display = 'none';
        } else {
            document.getElementById('modalTitle').innerText = 'Uprav používateľa';
            ['userName','userSurname','userEmail','userPhone',].forEach(id => {
                document.getElementById(id).removeAttribute('disabled');
            });
            if (saveBtn) saveBtn.style.display = 'inline-block';
        }
        document.getElementById('userModal').style.display = 'flex';
     }

    function closeUserModal() {
        document.getElementById('userModal').style.display = 'none';
        // ensure fields are enabled again
        ['userName','userSurname','userEmail','userPhone'].forEach(id => {
            const el = document.getElementById(id);
            if (el) el.removeAttribute('disabled');
        });
     }

    async function saveUser() {
        const id = document.getElementById('userId').value;
        const payload = {
            name: document.getElementById('userName').value,
            surname: document.getElementById('userSurname').value,
            email: document.getElementById('userEmail').value,
            phone: document.getElementById('userPhone').value,

        };

        try {
            const res = await axios.put(`/admin/users/${id}`, payload);
            alert('Uložené');
            closeUserModal();
            // optionally refresh page to show updated data
            window.location.reload();
        } catch (err) {
            alert('Chyba pri uložení');
            console.error(err);
        }
    }

    async function deleteUser(id) {
        if (!confirm('Naozaj chcete používateľa vymazať?')) return;
        try {
            await axios.delete(`/admin/users/${id}`);
            alert('Používateľ vymazaný');
            window.location.reload();
        } catch (err) {
            alert('Chyba pri mazani');
            console.error(err);
        }
    }

    // helper called by logout button
    function handleLogout() {
        const token = localStorage.getItem('userToken');

        if (!token) {
            window.location.href = '/prihlasenie';
            return;
        }

        axios.post(`${API_URL}/logout`, {}, {
            headers: { 'Authorization': `Bearer ${token}` }
        }).finally(() => {
            localStorage.removeItem('userToken');
            localStorage.removeItem('user');
            window.location.href = '/prihlasenie';
        });
    }
</script>

</body>
</html>
