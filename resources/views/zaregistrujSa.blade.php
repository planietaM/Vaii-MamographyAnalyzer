<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Registrácia – Mamography Analyzer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* ================== RESET ================== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            background: #f9fafb;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #111827;
            line-height: 1.5;
            overflow-x: hidden;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* ================== HEADER ================== */
        header {
            padding: 20px 0;
            background: #f9fafb;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .logo {
            font-size: clamp(18px, 2.5vw, 24px);
            font-weight: 900;
            color: #c026d3;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: clamp(12px, 2vw, 28px);
            flex-wrap: wrap;
        }

        .nav-links a {
            color: #c026d3;
            font-size: clamp(12px, 1.5vw, 14px);
            font-weight: 500;
            white-space: nowrap;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        /* ================== MAIN ================== */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(40px, 6vw, 60px) 20px;
        }

        /* ================== LOGIN CARD ================== */
        .login-wrapper {
            width: 100%;
            max-width: 620px;
        }

        .login-card {
            background: #fff;
            padding: clamp(32px, 5vw, 48px) clamp(28px, 4vw, 44px);
            border-radius: clamp(24px, 3vw, 32px);
            box-shadow: 0 20px 60px rgba(156, 11, 142, 0.12);
        }

        .login-header {
            text-align: center;
            margin-bottom: clamp(28px, 4vw, 36px);
        }

        .login-title {
            font-size: clamp(26px, 4vw, 36px);
            font-weight: 900;
            color: #111;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #9c0b8e 0%, #d04fa7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .login-subtitle {
            font-size: clamp(14px, 1.7vw, 16px);
            color: #6b7280;
        }

        /* ================== FORM ================== */
        .form-group {
            margin-bottom: clamp(18px, 2.5vw, 24px);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(14px, 2vw, 18px);
        }

        .form-label {
            display: block;
            font-size: clamp(13px, 1.5vw, 15px);
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-input,
        select.form-input {
            width: 100%;
            padding: clamp(12px, 1.7vw, 15px) clamp(14px, 2vw, 16px);
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            font-size: clamp(14px, 1.7vw, 16px);
            transition: all 0.2s ease;
            background: #f9fafb;
            font-family: inherit;
        }

        .form-input:focus {
            outline: none;
            border-color: #c026d3;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(192, 38, 211, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        select.form-input {
            cursor: pointer;
        }

        /* ================== ACCOUNT TYPE SELECTOR ================== */
        .account-type-selector {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(12px, 2vw, 16px);
            margin-top: 8px;
        }

        .account-type-option {
            cursor: pointer;
        }

        .account-type-option input[type="radio"] {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .account-type-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: clamp(16px, 2.5vw, 22px) clamp(12px, 2vw, 16px);
            border: 2px solid #e5e7eb;
            border-radius: 14px;
            background: #f9fafb;
            transition: all 0.2s ease;
            min-height: 90px;
        }

        .account-type-option:hover .account-type-card {
            border-color: #d1d5db;
        }

        .account-type-option input[type="radio"]:checked + .account-type-card {
            border-color: #c026d3;
            background: linear-gradient(135deg, rgba(156, 11, 142, 0.05) 0%, rgba(208, 79, 167, 0.05) 100%);
            box-shadow: 0 0 0 3px rgba(192, 38, 211, 0.1);
        }

        .account-type-icon {
            font-size: clamp(28px, 4vw, 36px);
            margin-bottom: 6px;
        }

        .account-type-label {
            font-size: clamp(13px, 1.6vw, 15px);
            font-weight: 600;
            color: #374151;
            text-align: center;
        }

        .account-type-option input[type="radio"]:checked + .account-type-card .account-type-label {
            color: #c026d3;
        }

        /* ================== CONDITIONAL FIELDS ================== */
        .conditional-fields {
            margin-top: 4px;
        }

        /* ================== BUTTON ================== */
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #9c0b8e 0%, #d04fa7 100%);
            color: #fff;
            padding: clamp(13px, 1.9vw, 17px);
            border: none;
            border-radius: 12px;
            font-size: clamp(15px, 1.9vw, 17px);
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(156, 11, 142, 0.3);
            margin-top: clamp(8px, 1.5vw, 12px);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 28px rgba(156, 11, 142, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        /* ================== FOOTER ================== */
        .login-footer {
            text-align: center;
            margin-top: clamp(24px, 3.5vw, 32px);
            padding-top: clamp(20px, 3vw, 28px);
            border-top: 1px solid #e5e7eb;
        }

        .login-footer-text {
            font-size: clamp(13px, 1.6vw, 15px);
            color: #6b7280;
        }

        .login-footer-link {
            color: #c026d3;
            font-weight: 600;
        }

        .login-footer-link:hover {
            text-decoration: underline;
        }

        /* ================== RESPONSIVE ================== */
        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
                align-items: flex-start;
            }

            main {
                padding: clamp(30px, 5vw, 50px) 16px;
            }

            .login-card {
                padding: clamp(26px, 5vw, 36px) clamp(22px, 4vw, 30px);
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }
        }

        @media (max-width: 480px) {
            .login-card {
                padding: clamp(22px, 5vw, 30px) clamp(18px, 4vw, 26px);
            }

            .login-title {
                font-size: clamp(22px, 6vw, 30px);
            }

            .account-type-selector {
                grid-template-columns: 1fr;
            }

            .account-type-card {
                flex-direction: row;
                gap: 12px;
                min-height: auto;
                padding: 14px 16px;
                justify-content: flex-start;
            }

            .account-type-icon {
                font-size: 26px;
                margin-bottom: 0;
            }

            .account-type-label {
                text-align: left;
            }
        }
    </style>
</head>
<body>

<header>
    <div class="container nav">
        <div class="logo">Mamography Analyzer</div>
        <ul class="nav-links">
            <li><a href="/">Domov</a></li>
            <li><a href="#">O nás</a></li>
            <li><a href="#">Kontakt</a></li>
        </ul>
    </div>
</header>

<main>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <h1 class="login-title">Registrácia</h1>
                <p class="login-subtitle">Vytvorte si nový účet</p>
            </div>

            <form id="registerForm">
                {{-- Výber typu účtu --}}
                <div class="form-group">
                    <label class="form-label">Typ účtu</label>
                    <div class="account-type-selector">
                        <label class="account-type-option">
                            <input type="radio" name="account_type" value="doktor" id="typeDoktor" checked>
                            <span class="account-type-card">
                                <span class="account-type-icon">👨‍⚕️</span>
                                <span class="account-type-label">Lekár / Doktor</span>
                            </span>
                        </label>
                        <label class="account-type-option">
                            <input type="radio" name="account_type" value="pacient" id="typePacient">
                            <span class="account-type-card">
                                <span class="account-type-icon">🧑‍💼</span>
                                <span class="account-type-label">Pacient</span>
                            </span>
                        </label>
                    </div>
                </div>

                {{-- Spoločné polia --}}
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="meno">Meno *</label>
                        <input
                            type="text"
                            id="meno"
                            name="meno"
                            class="form-input"
                            placeholder="Vaše meno"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="priezvisko">Priezvisko *</label>
                        <input
                            type="text"
                            id="priezvisko"
                            name="priezvisko"
                            class="form-input"
                            placeholder="Vaše priezvisko"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email *</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        placeholder="vas.email@example.com"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="telefon">Telefón</label>
                    <input
                        type="tel"
                        id="telefon"
                        name="telefon"
                        class="form-input"
                        placeholder="+421 XXX XXX XXX"
                    >
                </div>

                {{-- Polia len pre doktora --}}
                <div id="doktorFields" class="conditional-fields">
                    <div class="form-group">
                        <label class="form-label" for="dikter_id">Dikter ID *</label>
                        <input
                            type="text"
                            id="dikter_id"
                            name="dikter_id"
                            class="form-input"
                            placeholder="Zadajte vaše dikter ID"
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="specializacia">Špecializácia</label>
                        <select id="specializacia" name="specializacia" class="form-input">
                            <option value="">Vyberte špecializáciu</option>
                            <option value="radiologia">Rádiológia</option>
                            <option value="onkologia">Onkológia</option>
                            <option value="chirurgia">Chirurgia</option>
                            <option value="gynekologia">Gynekológia</option>
                            <option value="ine">Iné</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="pracovisko">Pracovisko</label>
                        <input
                            type="text"
                            id="pracovisko"
                            name="pracovisko"
                            class="form-input"
                            placeholder="Nemocnica / Klinika"
                        >
                    </div>
                </div>

                {{-- Polia len pre pacienta --}}
                <div id="pacientFields" class="conditional-fields" style="display: none;">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="rodne_cislo">Rodné číslo *</label>
                            <input
                                type="text"
                                id="rodne_cislo"
                                name="rodne_cislo"
                                class="form-input"
                                placeholder="XXXXXX/XXXX"
                            >
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="datum_narodenia">Dátum narodenia *</label>
                            <input
                                type="date"
                                id="datum_narodenia"
                                name="datum_narodenia"
                                class="form-input"
                            >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="pohlavie">Pohlavie *</label>
                        <select id="pohlavie" name="pohlavie" class="form-input">
                            <option value="">Vyberte pohlavie</option>
                            <option value="zena">Žena</option>
                            <option value="muz">Muž</option>
                        </select>
                    </div>
                </div>

                {{-- Heslo --}}
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="password">Heslo *</label>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-input"
                            placeholder="Min. 8 znakov"
                            required
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirm">Potvrďte heslo *</label>
                        <input
                            type="password"
                            id="password_confirm"
                            name="password_confirm"
                            class="form-input"
                            placeholder="Zopakujte heslo"
                            required
                        >
                    </div>
                </div>

                <button type="submit" class="btn-submit">Zaregistrovať sa</button>
            </form>

            <div class="login-footer">
                <p class="login-footer-text">
                    Už máte účet?
                    <a href="{{ route('login') }}" class="login-footer-link">Prihláste sa</a>
                </p>
            </div>
        </div>
    </div>
</main>

<script>
    // Prepínanie medzi typmi účtov
    const typeDoktor = document.getElementById('typeDoktor');
    const typePacient = document.getElementById('typePacient');
    const doktorFields = document.getElementById('doktorFields');
    const pacientFields = document.getElementById('pacientFields');

    function toggleAccountType() {
        if (typeDoktor.checked) {
            doktorFields.style.display = 'block';
            pacientFields.style.display = 'none';

            // Required pre doktora
            document.getElementById('dikter_id').required = true;

            // Nie required pre pacienta
            document.getElementById('rodne_cislo').required = false;
            document.getElementById('datum_narodenia').required = false;
            document.getElementById('pohlavie').required = false;
        } else {
            doktorFields.style.display = 'none';
            pacientFields.style.display = 'block';

            // Required pre pacienta
            document.getElementById('rodne_cislo').required = true;
            document.getElementById('datum_narodenia').required = true;
            document.getElementById('pohlavie').required = true;

            // Nie required pre doktora
            document.getElementById('dikter_id').required = false;
        }
    }

    typeDoktor.addEventListener('change', toggleAccountType);
    typePacient.addEventListener('change', toggleAccountType);

    // Validácia formulára
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const password = document.getElementById('password').value;
        const passwordConfirm = document.getElementById('password_confirm').value;

        if (password !== passwordConfirm) {
            alert('Heslá sa nezhodujú!');
            return;
        }

        if (password.length < 8) {
            alert('Heslo musí mať aspoň 8 znakov!');
            return;
        }

        // Tu by bola skutočná logika na registráciu
        const accountType = typeDoktor.checked ? 'Doktor' : 'Pacient';
        alert('Registrácia prebieha...\nTyp účtu: ' + accountType);
    });
</script>

</body>
</html>
