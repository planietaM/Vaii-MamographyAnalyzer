<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Prihlásenie – Mamography Analyzer</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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

        /* ================== LAYOUT ================== */
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
            width: 100%;
        }

        /* ================== HEADER ================== */
        header {
            padding: 20px 0;
            background: #f9fafb;
            width: 100%;
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

        /* ================== MAIN CONTENT ================== */
        main {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: clamp(40px, 6vw, 80px) 20px;
        }

        /* ================== LOGIN CARD ================== */
        .login-wrapper {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: #fff;
            padding: clamp(36px, 5vw, 48px) clamp(32px, 4vw, 44px);
            border-radius: clamp(24px, 3vw, 32px);
            box-shadow: 0 20px 60px rgba(156, 11, 142, 0.12);
        }

        .login-header {
            text-align: center;
            margin-bottom: clamp(32px, 4vw, 40px);
        }

        .login-title {
            font-size: clamp(28px, 4vw, 36px);
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
            margin-bottom: clamp(20px, 2.8vw, 28px);
        }

        .form-label {
            display: block;
            font-size: clamp(14px, 1.6vw, 15px);
            font-weight: 600;
            color: #374151;
            margin-bottom: 10px;
        }

        .form-input {
            width: 100%;
            padding: clamp(13px, 1.8vw, 16px) clamp(16px, 2.2vw, 18px);
            border: 2px solid #e5e7eb;
            border-radius: 14px;
            font-size: clamp(15px, 1.8vw, 16px);
            transition: all 0.2s ease;
            background: #f9fafb;
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

        /* ================== BUTTON ================== */
        .btn-submit {
            width: 100%;
            background: linear-gradient(135deg, #9c0b8e 0%, #d04fa7 100%);
            color: #fff;
            padding: clamp(14px, 2vw, 18px);
            border: none;
            border-radius: 14px;
            font-size: clamp(16px, 2vw, 18px);
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

        /* ================== FOOTER LINK ================== */
        .login-footer {
            text-align: center;
            margin-top: clamp(28px, 3.5vw, 36px);
            padding-top: clamp(24px, 3vw, 32px);
            border-top: 1px solid #e5e7eb;
        }

        .login-footer-text {
            font-size: clamp(14px, 1.6vw, 15px);
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

            .nav-links {
                gap: 12px;
            }

            main {
                padding: clamp(30px, 5vw, 50px) 16px;
            }

            .login-card {
                padding: clamp(28px, 5vw, 40px) clamp(24px, 4vw, 32px);
            }
        }

        @media (max-width: 480px) {
            .login-card {
                padding: clamp(24px, 5vw, 32px) clamp(20px, 4vw, 28px);
            }

            .login-title {
                font-size: clamp(24px, 6vw, 32px);
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
            <li><a href="{{ route('o-nas') }}">O nás</a></li>
            <li><a href="#">Kontakt</a></li>
        </ul>
    </div>
</header>

<main>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <h1 class="login-title">Prihlásenie</h1>
                <p class="login-subtitle">Zadajte svoje prihlasovacie údaje</p>
            </div>

            <form id="loginForm">
                <div class="form-group">
                    <label class="form-label" for="email">Emailová adresa</label>
                    <input
                        type="email"
                        id="email"               class="form-input"
                        placeholder="Zadajte vašu emailovú adresu"
                        required
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Heslo</label>
                    <input
                        type="password"
                        id="password"
                        class="form-input"
                        placeholder="Zadajte vaše heslo"
                        required
                    >
                </div>

                <button type="submit" class="btn-submit">Prihlásiť sa</button>
            </form>

            <!-- Fallback non-AJAX login form (submitted when AJAX fails) -->
            <form id="fallbackLoginForm" method="POST" action="/web-login" style="display:none;">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <input type="hidden" name="email" id="fallbackEmail" />
                <input type="hidden" name="password" id="fallbackPassword" />
            </form>

            <div class="login-footer">
                <p class="login-footer-text">
                    Nemáte účet?
                    <a href="/registracia" class="login-footer-link">Zaregistrujte sa</a>
                </p>
            </div>
        </div>
    </div>
</main>

<script>
    // Nastavíme URL k Laravel Back-endu z prostredia, aby nebola hardcoded
    const API_URL = '{{ url('/api') }}';

    // Ensure axios exists and set defaults used across the app
    if (typeof axios !== 'undefined') {
        axios.defaults.baseURL = API_URL;
        axios.defaults.withCredentials = true; // send cookies for sanctum/session flows
        axios.defaults.headers.common['Accept'] = 'application/json';
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    }

    document.getElementById('loginForm').addEventListener('submit', async function(e) {
        e.preventDefault();

        // 1. Získanie hodnôt
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        // Save original withCredentials so we always restore it
        const originalWithCredentials = axios.defaults.withCredentials;

        try {
            // Clear any stale token/cookie state before attempting token-based login
            try {
                localStorage.removeItem('userToken');
            } catch (e) { /* ignore */ }
            if (axios.defaults && axios.defaults.headers && axios.defaults.headers.common) {
                delete axios.defaults.headers.common['Authorization'];
            }
            // Ensure we send cookies so the backend can create a session cookie if it wants
            axios.defaults.withCredentials = true;

            // 2. Volanie Laravel API s Axios na /login (baseURL sa už nastaví)
            const response = await axios.post(`/login`, {
                email: email,
                password: password,
            });

            // Do NOT change withCredentials here (keep sending cookies)

            // Tolerant parsing: accept multiple possible shapes returned by different auth implementations
            const data = response && response.data ? response.data : null;
            const access_token = data?.access_token || data?.token || data?.accessToken || data?.data?.access_token || null;
            const user = data?.user || data?.data?.user || null;

            if (!user || !access_token) {
                console.error('Unexpected login response (full):', response);
                // If server returned HTML (e.g. redirect), show more helpful guidance
                const contentType = response && response.headers && response.headers['content-type'] ? response.headers['content-type'] : null;
                let debugMsg = '';
                if (contentType && contentType.includes('text/html')) {
                    debugMsg = 'Server returned HTML (possible redirect). Try clearing cookies or use the non-AJAX login.';
                } else if (response && response.status && response.status !== 200) {
                    debugMsg = `Server returned status ${response.status}.`;
                } else {
                    debugMsg = 'Server returned an unexpected JSON shape.';
                }
                alert('Prihlásenie zlyhalo: server nevrátil očakávané údaje. ' + debugMsg + ' Skontrolujte backend alebo konzolu pre viac detailov.');
                return;
            }

            // 3. Uloženie tokenu a user dát do prehliadača (localStorage)
            localStorage.setItem('userToken', access_token);
            localStorage.setItem('user', JSON.stringify(user));

            // set Authorization header for future API calls
            axios.defaults.headers.common['Authorization'] = `Bearer ${access_token}`;

            // Defensive console.log: use optional chaining so we don't read .email of null
            console.log('Prihlásenie úspešné. Token uložený pre: ' + (user?.email ?? '[email not provided]'));

            // 4. Presmerovanie na chránený dashboard
            window.location.href = '/dashboard';

        } catch (error) {
            // Ensure withCredentials remains true for consistent behavior
            axios.defaults.withCredentials = true;

            console.error('Chyba pri prihlásení:', error);

            let errorMessage = 'Nastala chyba pri komunikácii so serverom.';

            if (error.response) {
                // Spracovanie chýb z Back-endu (napr. 401 Unauthorized)
                if (error.response.status === 401) {
                    errorMessage = 'Nesprávny email alebo heslo.';
                } else if (error.response.data && error.response.data.message) {
                    errorMessage = error.response.data.message;
                } else if (error.response.data && error.response.data.errors && error.response.data.errors.email) {
                    // Ak nastane chyba validácie (napr. rate limit)
                    errorMessage = error.response.data.errors.email[0];
                } else {
                    // show response body for debugging
                    console.error('Login error response data:', error.response.data);
                }
            } else if (error.request) {
                // Request bol odoslaný ale odpoveď neprichádza (možno CORS alebo server offline)
                console.error('No response received. Possible server offline or CORS issue.', error.request);
                errorMessage = 'Server neodpovedá. Skontrolujte, či je back-end spustený a CORS nastavenie.';

                // Submit fallback non-AJAX form so the server can attempt a regular session-based login
                try {
                    document.getElementById('fallbackEmail').value = email;
                    document.getElementById('fallbackPassword').value = password;
                    document.getElementById('fallbackLoginForm').submit();
                    return; // don't show alert because we're redirecting
                } catch (e) {
                    console.error('Fallback form submit failed:', e);
                }
            } else {
                // Niečo sa pokazilo pri nastavovaní requestu
                console.error('Error setting up request:', error.message);
                // if this is a runtime TypeError (like reading user.email), show friendly message and log details
                errorMessage = 'Chyba pri príprave požiadavky: ' + (error.message || String(error));
            }

            alert(errorMessage);
        }
    });
</script>

</body>
</html>
