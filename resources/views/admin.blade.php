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

        /* Modal dialog (shared styles for admin modals, matches doctor's view) */
        .modal-dialog {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .modal-content-box {
            background: #fff;
            padding: 1.25rem;
            border-radius: 0.75rem;
            width: 520px;
            max-width: 95%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 12px 32px rgba(15,23,42,0.12);
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

        /* image preview modal */
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
<div id="userModal" class="modal-dialog">
    <div class="modal-content-box">
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
                <select id="userRole" name="role" style="flex:1; padding:8px;">
                    <option value="patient">Pacient</option>
                    <option value="doctor">Doktor</option>
                    <option value="admin">Admin</option>
                </select>
             </div>

            <div style="display:flex; gap:8px; justify-content:flex-end;">
                <button type="button" onclick="closeUserModal()" style="padding:8px 12px;">Zrušiť</button>
                <button id="saveUserBtn" type="button" onclick="saveUser()" style="background:#9c0b8e;color:#fff;padding:8px 12px;border-radius:6px;border:none;">Uložiť</button>
            </div>
         </form>
     </div>
 </div>

<!-- Examination upload modal -->
<div id="examModal" class="modal-dialog">
    <div class="modal-content-box">
         <h3 id="examModalTitle">Nahraj vyšetrenie</h3>
         <form id="examForm">
             <input type="hidden" id="examPatientId" />
             <div style="display:flex; gap:8px; margin-bottom:8px;">
                 <input type="file" accept="image/*" id="examPhoto" style="flex:1; padding:8px;" />
             </div>
             <div style="display:flex; gap:8px; margin-bottom:8px; align-items:center;">
                <label><input type="radio" name="result" value="negative" checked /> Negatívny</label>
                <label><input type="radio" name="result" value="positive" /> Pozitívny</label>
             </div>
            <div style="display:flex; gap:8px; justify-content:flex-end;">
                <button type="button" onclick="closeExamModal()" style="padding:8px 12px;">Zrušiť</button>
                <button id="uploadExamBtn" type="button" onclick="uploadExam()" style="background:#9c0b8e;color:#fff;padding:8px 12px;border-radius:6px;border:none;">Nahrať</button>
            </div>
         </form>
     </div>
 </div>

<!-- Webinar modal -->
<div id="webinarModal" class="modal-dialog">
    <div class="modal-content-box" style="max-width:600px; width:95%;">
         <h3 id="webinarModalTitle">Pridať / Upraviť webinár</h3>
         <form id="webinarForm">
            <input type="hidden" id="webinarId" name="id" />
            <div style="display:flex; gap:8px; margin-bottom:8px; flex-direction:column;">
                <input placeholder="Názov" name="title" id="webinarTitle" style="padding:8px;" required />
                <textarea placeholder="Stručný text" name="short_text" id="webinarShortText" style="padding:8px; min-height:80px; margin-top:8px;" required></textarea>
                <div style="display:flex; gap:8px; margin-top:8px;">
                    <input type="datetime-local" name="date" id="webinarDate" style="flex:1; padding:8px;" required />
                    <input placeholder="Miesto" name="location" id="webinarLocation" style="flex:1; padding:8px;" />
                </div>
                <input placeholder="Tel. kontakt" name="telephone" id="webinarTelephone" style="padding:8px; margin-top:8px;" />
                <!-- image upload removed for webinars per request -->
            </div>

            <div style="display:flex; gap:8px; justify-content:flex-end; margin-top:8px;">
                <button type="button" onclick="closeWebinarModal()" style="padding:8px 12px;">Zrušiť</button>
                <button id="saveWebinarBtn" type="button" onclick="saveWebinar()" style="background:#9c0b8e;color:#fff;padding:8px 12px;border-radius:6px;border:none;">Uložiť</button>
            </div>
         </form>
     </div>
 </div>

<!-- Testimonial modal -->
<div id="testimonialModal" class="modal-dialog">
    <div class="modal-content-box" style="max-width:560px; width:95%;">
         <h3 id="testimonialModalTitle">Pridať / Upraviť doktora</h3>
         <form id="testimonialForm">
            <input type="hidden" id="testimonialId" name="id" />
            <div style="display:flex; flex-direction:column; gap:8px;">
                <input placeholder="Meno" name="name" id="testimonialName" style="padding:8px;" required />
                <input placeholder="Rola (napr. Primárka rádiológie, Trnava)" name="role" id="testimonialRole" style="padding:8px;" />
                <textarea placeholder="Text / citát" name="text" id="testimonialText" style="padding:8px; min-height:80px;"></textarea>
                <input type="file" accept="image/*" id="testimonialImageFile" name="image_file" style="padding:8px;" />
            </div>

            <div style="display:flex; gap:8px; justify-content:flex-end; margin-top:8px;">
                <button type="button" onclick="closeTestimonialModal()" style="padding:8px 12px;">Zrušiť</button>
                <button id="saveTestimonialBtn" type="button" onclick="saveTestimonial()" style="background:#9c0b8e;color:#fff;padding:8px 12px;border-radius:6px;border:none;">Uložiť</button>
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
                            <th>Priezvisko</th>
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
                            <td>{{ $p->surname ?? '-' }}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->phone ?? '-' }}</td>
                            <td>{{ $p->last_exam_date ?? 'Žiadne vyšetrenie' }}</td>
                            <td><button class="btn-action btn-view" onclick="viewUser({{ $p->id }})">Zobraziť</button></td>
                            <td><button class="btn-action btn-edit" onclick="openUserModal({{ json_encode($p) }})">Upraviť</button></td>
                            <td><button class="btn-action btn-delete" onclick="deleteUser({{ $p->id }})">Vymazať</button></td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9">Žiadni pacienti.</td>
                        </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Webináre</h2>
                <button class="btn-add" onclick="openWebinarModal()">Pridať webinár</button>
            </div>

            <div class="table-container">
                <div class="table-wrapper">
                    <table id="webinarsTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Názov</th>
                                <th>Dátum</th>
                                <th>Miesto</th>
                                <th>Tel.</th>
                                <th>Zobraziť</th>
                                <th>Upraviť</th>
                                <th>Vymazať</th>
                            </tr>
                        </thead>
                        <tbody id="webinarTbody">
                            <tr><td colspan="6">Načítavam...</td></tr>
                        </tbody>
                     </table>
                 </div>
             </div>
         </div>

        <div class="section">
            <div class="section-header">
                <h2 class="section-title">Testimonialy / Doktori</h2>
                <button class="btn-add" onclick="openTestimonialModal()">Pridať doktora</button>
            </div>

            <div class="table-container">
                <div class="table-wrapper">
                    <table id="testimonialsTable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Obr.</th>
                            <th>Meno</th>
                            <th>Rola</th>
                            <th>Zobraziť</th>
                            <th>Upraviť</th>
                            <th>Vymazať</th>
                        </tr>
                        </thead>
                        <tbody id="testimonialTbody">
                            @if(isset($testimonials) && $testimonials->count())
                                @foreach($testimonials as $t)
                                    <tr>
                                        <td>{{ $t->id }}</td>
                                        <td><img src="{{ $t->image_data ?? '/images/profile1.png' }}" style="width:48px;height:48px;border-radius:999px;object-fit:cover" alt="avatar"></td>
                                        <td>{{ $t->name }}</td>
                                        <td>{{ $t->role ?? '-' }}</td>
                                        <td>
                                            <button class="btn-action btn-view"
                                                data-testimonial="{{ base64_encode(json_encode($t->only(['id','name','role','text']))) }}"
                                                onclick="openTestimonialModalWithData(JSON.parse(atob(this.dataset.testimonial)), 'view')">Zobraziť</button>
                                        </td>
                                        <td>
                                            <button class="btn-action btn-edit"
                                                data-testimonial="{{ base64_encode(json_encode($t->only(['id','name','role','text']))) }}"
                                                onclick="openTestimonialModalWithData(JSON.parse(atob(this.dataset.testimonial)), 'edit')">Upraviť</button>
                                        </td>
                                        <td><button class="btn-action btn-delete" onclick="deleteTestimonial({{ $t->id }})">Vymazať</button></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="7">Načítavam...</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    // Configure axios default headers
    // Set CSRF token for axios
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    if (csrfMeta) {
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfMeta.getAttribute('content');
    }
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    // NO baseURL - používame relatívne cesty od root

    async function viewUser(id) {
        try {
            const res = await axios.get(`/admin/users/${id}`);
            const payload = res && res.data ? res.data : res;
            openUserModal(payload, 'view');
        } catch (err) {
            alert('Chyba pri načítaní používateľa');
            console.error(err);
        }
    }

    // Open exam modal for uploading an exam for a given patient (called by doctor buttons)
    function openExamModalForPatient(patientId) {
        document.getElementById('examPatientId').value = patientId;
        document.getElementById('examModalTitle').innerText = 'Nahraj vyšetrenie pre pacienta ' + patientId;
        document.getElementById('examForm').reset?.();
        document.getElementById('examModal').style.display = 'flex';
    }

    function openUserModal(user, mode = 'edit') {
        user = user || {};
        document.getElementById('userId').value = user.id || '';
        document.getElementById('userName').value = user.name || '';
        document.getElementById('userSurname').value = user.surname || '';
        document.getElementById('userEmail').value = user.email || '';
        document.getElementById('userPhone').value = user.phone || '';

        // Nastavenie roly
        const roleSelect = document.getElementById('userRole');
        if (roleSelect) {
            roleSelect.value = user.role || 'patient';
            // Rola je VŽDY disabled - nemôže sa meniť
            roleSelect.setAttribute('disabled', 'disabled');
        }


        const saveBtn = document.getElementById('saveUserBtn');
        if (mode === 'view') {
            document.getElementById('modalTitle').innerText = 'Zobraziť používateľa';
            ['userName','userSurname','userEmail','userPhone'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.setAttribute('disabled','disabled');
            });
            if (saveBtn) saveBtn.style.display = 'none';
        } else {
            document.getElementById('modalTitle').innerText = 'Upraviť používateľa';
            ['userName','userSurname','userEmail','userPhone'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.removeAttribute('disabled');
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
            alert('Chyba pri uložení: ' + (err.response?.data?.message || err.message));
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
            alert('Chyba pri mazaní: ' + (err.response?.data?.message || err.message));
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

        axios.post('/api/logout', {}, {
            headers: { 'Authorization': `Bearer ${token}` }
        }).finally(() => {
            localStorage.removeItem('userToken');
            localStorage.removeItem('user');
            window.location.href = '/prihlasenie';
        });
    }

    function closeExamModal() {
        const modal = document.getElementById('examModal');
        if (modal) modal.style.display = 'none';
    }

    async function uploadExam() {
        const patientId = document.getElementById('examPatientId').value;
        const fileInput = document.getElementById('examPhoto');
        if (!fileInput || !fileInput.files || fileInput.files.length === 0) {
            alert('Vyber súbor s fotkou');
            return;
        }

        const fd = new FormData();
        fd.append('patient_id', patientId);
        fd.append('photo', fileInput.files[0]);
        const result = document.querySelector('input[name="result"]:checked').value;
        fd.append('result', result);

        try {
            const res = await axios.post('/admin/examinations', fd, { headers: { 'Content-Type': 'multipart/form-data' } });
            alert('Vyšetrenie uložené');
            closeExamModal();
            window.location.reload();
        } catch (err) {
            console.error('Chyba pri nahrávaní vyšetrenia', err);
            alert('Chyba pri nahrávaní vyšetrenia');
        }
    }

    // Webinars admin JS (CRUD)
    async function fetchWebinars() {
        try {
            const res = await axios.get('/admin/webinars');
            const list = res.data || [];
            const tbody = document.getElementById('webinarTbody');
            if (!list.length) {
                tbody.innerHTML = '<tr><td colspan="7">Žiadne webináre.</td></tr>';
                return;
            }
            const rows = list.map(w => `
                <tr>
                    <td>${w.id}</td>
                    <td>${escapeHtml(w.title)}</td>
                    <td>${w.date ? new Date(w.date).toLocaleString() : '-'}</td>
                    <td>${escapeHtml(w.location || '-')}</td>
                    <td>${escapeHtml(w.telephone || '-')}</td>
                    <td > <button class="btn-action btn-view" onclick='viewWebinar(${w.id})'>Zobraziť</button> </td>
                    <td><button class="btn-action btn-edit" onclick='editWebinar(${w.id})'>Upraviť</button></td>
                    <td><button class="btn-action btn-delete" onclick='deleteWebinar(${w.id})'>Vymazať</button></td>
                </tr>`).join('');
            tbody.innerHTML = rows;
        } catch (err) {
            console.error('Chyba pri načítaní webinárov', err);
            const tbody = document.getElementById('webinarTbody');
            tbody.innerHTML = '<tr><td colspan="6">Chyba pri načítaní.</td></tr>';
        }
    }

    function openWebinarModal() {
        document.getElementById('webinarForm').reset();
        document.getElementById('webinarId').value = '';
        document.getElementById('webinarModalTitle').innerText = 'Pridať webinár';
        document.getElementById('webinarModal').style.display = 'flex';
    }

    function closeWebinarModal() {
        document.getElementById('webinarModal').style.display = 'none';
    }

    async function saveWebinar() {
        const id = document.getElementById('webinarId').value;
        const v = document.getElementById('webinarDate').value;
        const payload = {
            title: document.getElementById('webinarTitle').value,
            short_text: document.getElementById('webinarShortText').value,
            date: v ? new Date(v).toISOString() : null,
            location: document.getElementById('webinarLocation').value,
            telephone: document.getElementById('webinarTelephone').value,
        };

        try {
            if (id) {
                await axios.put(`/admin/webinars/${id}`, payload);
                alert('Webinár aktualizovaný');
            } else {
                await axios.post('/admin/webinars', payload);
                alert('Webinár vytvorený');
            }
            closeWebinarModal();
            fetchWebinars();
        } catch (err) {
            alert('Chyba pri uložení: ' + (err.response?.data?.message || err.message));
            console.error(err);
        }
    }

    function viewWebinar(id) {
        // show read-only in the modal
        axios.get(`/admin/webinars/${id}`).then(res => {
            const w = res.data;
            document.getElementById('webinarId').value = w.id;
            document.getElementById('webinarTitle').value = w.title;
            document.getElementById('webinarShortText').value = w.short_text;
            // fill datetime-local value from ISO
            if (w.date) {
                const dt = new Date(w.date);
                // format to yyyy-MM-ddTHH:mm
                const pad = n => n.toString().padStart(2,'0');
                const local = dt.getFullYear() + '-' + pad(dt.getMonth()+1) + '-' + pad(dt.getDate()) + 'T' + pad(dt.getHours()) + ':' + pad(dt.getMinutes());
                document.getElementById('webinarDate').value = local;
            }
            document.getElementById('webinarLocation').value = w.location || '';
            document.getElementById('webinarTelephone').value = w.telephone || '';
            document.getElementById('webinarModalTitle').innerText = 'Zobraziť webinár';
            // disable inputs
            ['webinarTitle','webinarShortText','webinarDate','webinarLocation','webinarTelephone'].forEach(id => document.getElementById(id).setAttribute('disabled','disabled'));
            document.getElementById('saveWebinarBtn').style.display = 'none';
            document.getElementById('webinarModal').style.display = 'flex';
        }).catch(err => { alert('Chyba pri načítaní webináru'); console.error(err); });
    }

    async function editWebinar(id) {
        try {
            const res = await axios.get(`/admin/webinars/${id}`);
            const w = res.data;
            document.getElementById('webinarId').value = w.id;
            document.getElementById('webinarTitle').value = w.title;
            document.getElementById('webinarShortText').value = w.short_text;
            if (w.date) {
                const dt = new Date(w.date);
                const pad = n => n.toString().padStart(2,'0');
                const local = dt.getFullYear() + '-' + pad(dt.getMonth()+1) + '-' + pad(dt.getDate()) + 'T' + pad(dt.getHours()) + ':' + pad(dt.getMinutes());
                document.getElementById('webinarDate').value = local;
            }
            document.getElementById('webinarLocation').value = w.location || '';
            document.getElementById('webinarTelephone').value = w.telephone || '';
            // enable inputs
            ['webinarTitle','webinarShortText','webinarDate','webinarLocation','webinarTelephone'].forEach(id => document.getElementById(id).removeAttribute('disabled'));
            document.getElementById('saveWebinarBtn').style.display = 'inline-block';
            document.getElementById('webinarModalTitle').innerText = 'Upraviť webinár';
            document.getElementById('webinarModal').style.display = 'flex';
        } catch (err) {
            alert('Chyba pri načítaní pre editáciu');
            console.error(err);
        }
    }

    async function deleteWebinar(id) {
        if (!confirm('Naozaj chcete webinár vymazať?')) return;
        try {
            await axios.delete(`/admin/webinars/${id}`);
            alert('Webinár vymazaný');
            fetchWebinars();
        } catch (err) {
            alert('Chyba pri mazaní: ' + (err.response?.data?.message || err.message));
            console.error(err);
        }
    }

    // Testimonials admin JS (CRUD)
    async function fetchTestimonials() {
        try {
            const res = await axios.get('/admin/testimonials');
            const list = res.data || [];
            const tbody = document.getElementById('testimonialTbody');
            if (!list.length) {
                tbody.innerHTML = '<tr><td colspan="8">Žiadni doktori/testimonialy.</td></tr>';
                return;
            }
            const rows = list.map(t => `
                <tr>
                    <td>${t.id}</td>
                    <td><img src="${t.image_data || '/images/profile1.png'}" style="width:48px;height:48px;border-radius:999px;object-fit:cover" alt="avatar"></td>
                    <td>${escapeHtml(t.name)}</td>
                    <td>${escapeHtml(t.role || '-')}</td>
                    <td><button class="btn-action btn-view" onclick='viewTestimonial(${t.id})'>Zobraziť</button></td>
                    <td><button class="btn-action btn-edit" onclick='editTestimonial(${t.id})'>Upraviť</button></td>
                    <td><button class="btn-action btn-delete" onclick='deleteTestimonial(${t.id})'>Vymazať</button></td>
                </tr>`).join('');
            tbody.innerHTML = rows;
        } catch (err) {
            console.error('Chyba pri načítaní testimonialov', err);
            document.getElementById('testimonialTbody').innerHTML = '<tr><td colspan="7">Chyba pri načítaní.</td></tr>';
        }
    }

    function openTestimonialModal() {
        document.getElementById('testimonialForm').reset();
        document.getElementById('testimonialId').value = '';
        document.getElementById('testimonialModalTitle').innerText = 'Pridať doktora';
        document.getElementById('testimonialModal').style.display = 'flex';
    }

    function closeTestimonialModal() {
        document.getElementById('testimonialModal').style.display = 'none';
    }

    async function saveTestimonial() {
        const id = document.getElementById('testimonialId').value;
        const form = new FormData();
        form.append('name', document.getElementById('testimonialName').value);
        form.append('role', document.getElementById('testimonialRole').value);
        form.append('text', document.getElementById('testimonialText').value);
        const fileInput = document.getElementById('testimonialImageFile');
        if (fileInput && fileInput.files && fileInput.files.length) {
            form.append('image_file', fileInput.files[0]);
        }

        form.append('position', 0);
        // active flag removed

        try {
            if (id) {
                await axios.post(`/admin/testimonials/${id}?_method=PUT`, form, { headers: { 'Content-Type': 'multipart/form-data' } });
                alert('Doktor aktualizovaný');
            } else {
                await axios.post('/admin/testimonials', form, { headers: { 'Content-Type': 'multipart/form-data' } });
                alert('Doktor vytvorený');
            }
            closeTestimonialModal();
            fetchTestimonials();
        } catch (err) {
            alert('Chyba pri uložení: ' + (err.response?.data?.message || err.message));
            console.error(err);
        }
    }

    async function viewTestimonial(id) {
        try {
            const res = await axios.get(`/admin/testimonials/${id}`);
            const t = res.data;
            document.getElementById('testimonialId').value = t.id;
            document.getElementById('testimonialName').value = t.name;
            document.getElementById('testimonialRole').value = t.role || '';
            document.getElementById('testimonialText').value = t.text || '';
            // image path removed; rely on uploaded image_data
             document.getElementById('testimonialModalTitle').innerText = 'Zobraziť doktora';
            ['testimonialName','testimonialRole','testimonialText'].forEach(id => document.getElementById(id).setAttribute('disabled','disabled'));
             document.getElementById('saveTestimonialBtn').style.display = 'none';
             document.getElementById('testimonialModal').style.display = 'flex';
        } catch (err) {
            alert('Chyba pri načítaní');
        }
    }

    async function editTestimonial(id) {
        try {
            const res = await axios.get(`/admin/testimonials/${id}`);
            const t = res.data;
            document.getElementById('testimonialId').value = t.id;
            document.getElementById('testimonialName').value = t.name;
            document.getElementById('testimonialRole').value = t.role || '';
            document.getElementById('testimonialText').value = t.text || '';
            // image path removed; file upload input remains empty for choosing a new file
            ['testimonialName','testimonialRole','testimonialText'].forEach(id => document.getElementById(id).removeAttribute('disabled'));
             document.getElementById('saveTestimonialBtn').style.display = 'inline-block';
             document.getElementById('testimonialModalTitle').innerText = 'Upraviť doktora';
             document.getElementById('testimonialModal').style.display = 'flex';
        } catch (err) {
            alert('Chyba pri načítaní pre edit');
        }
    }

    async function deleteTestimonial(id) {
        if (!confirm('Naozaj chcete vymazať?')) return;
        try {
            await axios.delete(`/admin/testimonials/${id}`);
            alert('Vymazané');
            fetchTestimonials();
        } catch (err) {
            alert('Chyba pri mazaní');
        }
    }

    // small helper to avoid XSS in table
    function escapeHtml(text) {
        if (!text) return '';
        return text.replace(/[&<>\"]/g, function(c) { return {'&':'&amp;','<':'&lt;','>':'&gt;','\\': '\\\\','"':'&quot;'}[c]; });
    }

    // Populate testimonial modal from server-rendered row data (no AJAX).
    function openTestimonialModalWithData(data, mode = 'edit') {
        if (!data) return;
        document.getElementById('testimonialForm').reset();
        document.getElementById('testimonialId').value = data.id || '';
        document.getElementById('testimonialName').value = data.name || '';
        document.getElementById('testimonialRole').value = data.role || '';
        document.getElementById('testimonialText').value = data.text || '';

        const saveBtn = document.getElementById('saveTestimonialBtn');
        if (mode === 'view') {
            ['testimonialName','testimonialRole','testimonialText'].forEach(id => document.getElementById(id).setAttribute('disabled','disabled'));
            if (saveBtn) saveBtn.style.display = 'none';
            document.getElementById('testimonialModalTitle').innerText = 'Zobraziť doktora';
        } else {
            ['testimonialName','testimonialRole','testimonialText'].forEach(id => document.getElementById(id).removeAttribute('disabled'));
            if (saveBtn) saveBtn.style.display = 'inline-block';
            document.getElementById('testimonialModalTitle').innerText = 'Upraviť doktora';
        }

        document.getElementById('testimonialModal').style.display = 'flex';
    }

    // fetch initially
    fetchWebinars();
    fetchTestimonials();
</script>

<script src="/js/admin.js"></script>

</body>
</html>
