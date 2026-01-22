# Mammography Analyzer

Webová aplikácia pre správu mamografických vyšetrení. Systém umožňuje riadenie používateľov s rôznymi rolami (Admin, Doktor, Pacient), správu vyšetrení a bezpečnú autentifikáciu.

## Funkcie

- **Autentifikácia a autorizácia** - Prihlasovanie/odhlasovanie s rôznymi rolami
- **Správa používateľov** - Admin môže spravovať doktorov a pacientov
- **Lekárske kódy** - Systém lekárskych kódov pre registráciu doktorov
- **Správa vyšetrení** - Doktori vytvárajú a spravujú mamografické vyšetrenia
- **Dashboard** - Prehľady pre každú rolu používateľa
- **RESTful API** - Plne funkčné API s AJAX volaniami
- **Responzívny dizajn** - Bootstrap 5 framework

## Požiadavky

- **PHP** 8.1 alebo vyššia
- **Composer** 2.x
- **SQLite** (predvolené) alebo **MySQL/MariaDB**
- **Node.js a NPM** (voliteľné, pre frontend assets)
- Webový server (Apache/Nginx) alebo PHP built-in server

## Inštalácia

### 1. Stiahnutie projektu

```bash
git clone <repository-url>
cd mamographyAnalyzer
```

### 2. Inštalácia PHP závislostí

```bash
composer install
```

### 3. Konfigurácia prostredia

Vytvorte `.env` súbor skopírovaním `.env.example`:

```bash
copy .env.example .env
```

### 4. Vygenerovanie aplikačného klúča

```bash
php artisan key:generate
```

### 5. Konfigurácia databázy

#### Použitie SQLite (predvolené):

```env
DB_CONNECTION=sqlite
DB_DATABASE=C:\Users\marpl\Desktop\Mamooo\mamographyAnalyzer\database\database.sqlite
```

Vytvorte databázový súbor:

```bash
type nul > database\database.sqlite
```

#### Použitie MySQL:

V `.env` nastavte:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mammography_db
DB_USERNAME=root
DB_PASSWORD=
```

Vytvorte databázu:

```sql
CREATE DATABASE mammography_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Spustenie migrácií

```bash
php artisan migrate
```

### 7. Naplnenie databázy testovacími dátami

```bash
php artisan db:seed
```

Tento príkaz vytvorí:
- Admin používateľa
- Testovacie lekárske kódy
- Prípadne ďalšie testovacie dáta

## Spustenie aplikácie

### Vývojové prostredie

Spustite Laravel development server:

```bash
php artisan serve
```

Aplikácia bude dostupná na: **http://localhost:8000**

### Produkčné prostredie

Pre produkciu nakonfigurujte webový server (Apache/Nginx) aby smeroval do `public/` adresára.

## Prihlasovacie údaje

Po spustení `php artisan db:seed` budú dostupné nasledujúce testovacie účty:

### Administrátor
- **Email**: `admin@example.com`
- **Heslo**: `password`

### Doktor
- **Email**: `doctor@example.com`
- **Heslo**: `password`

### Pacient
- **Email**: `patient@example.com`
- **Heslo**: `password`

## Štruktúra projektu

```
mamographyAnalyzer/
├── app/
│   ├── Http/
│   │   ├── Controllers/     # Kontroléry pre API a web
│   │   ├── Middleware/      # Custom middleware
│   │   └── Requests/        # Form Request validácie
│   ├── Models/              # Eloquent modely
│   │   ├── User.php
│   │   ├── Examination.php
│   │   └── DoctorCode.php
│   └── Policies/            # Authorization policies
├── database/
│   ├── migrations/          # Databázové migrácie
│   └── seeders/             # Seedery pre testovanie
├── public/
│   ├── css/                 # Štýly
│   ├── js/                  # JavaScript súbory (AJAX)
│   └── images/              # Obrázky
├── resources/
│   └── views/               # Blade šablóny
├── routes/
│   ├── web.php              # Web routes
│   ├── api.php              # API routes
│   └── auth.php             # Autentifikačné routes
└── scripts/                 # Helper skripty
```

## API Endpointy

### Autentifikácia
- `POST /api/login` - Prihlásenie
- `POST /api/logout` - Odhlásenie
- `POST /api/register` - Registrácia

### Používatelia (Admin)
- `GET /api/users` - Zoznam používateľov
- `GET /api/users/{id}` - Detail používateľa
- `POST /api/users` - Vytvorenie používateľa
- `PUT /api/users/{id}` - Aktualizácia používateľa
- `DELETE /api/users/{id}` - Vymazanie používateľa

### Vyšetrenia
- `GET /api/examinations` - Zoznam vyšetrení
- `GET /api/examinations/{id}` - Detail vyšetrenia
- `POST /api/examinations` - Vytvorenie vyšetrenia (Doktor)
- `PUT /api/examinations/{id}` - Aktualizácia vyšetrenia
- `DELETE /api/examinations/{id}` - Vymazanie vyšetrenia

### Lekárske kódy (Admin)
- `GET /api/doctor-codes` - Zoznam kódov
- `POST /api/doctor-codes` - Vytvorenie kódu


## Riešenie problémov

### Chyby s oprávneniami
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### Storage a cache adresáre
Uistite sa, že má webový server práva zápisu do:
- `storage/`
- `bootstrap/cache/`

### SQLite databáza neexistuje
```bash
type nul > database\database.sqlite
php artisan migrate:fresh --seed
```

## Bezpečnosť

- Všetky heslá sú hashované pomocou bcrypt
- CSRF ochrana na všetkých formulároch
- Middleware autentifikácia a autorizácia
- Policy-based prístupové práva
- Validácia na strane servera aj klienta

## Technológie

- **Backend**: Laravel 10.x (PHP 8.1+)
- **Frontend**: HTML5, CSS3, JavaScript (Vanilla JS)
- **Styling**: Bootstrap 5
- **Databáza**: SQLite / MySQL
- **API**: RESTful s JSON responses
- **Autentifikácia**: Laravel Sanctum

## Licencia

Tento projekt je open-source software licencovaný pod [MIT licenciou](https://opensource.org/licenses/MIT).
