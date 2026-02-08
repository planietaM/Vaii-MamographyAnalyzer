# Mamography Analyzer

Moja webová aplikácia umožňuje rádiológom overiť mamografické snímky a zistiť prítomnosť rakovinových buniek. Motiváciou je kombinácia štúdií a záujmu o medicínsku informatiku a využitie AI pri diagnostike rakoviny prsníka. Výber témy súvisí s mojím zámerom bakalárskej práce zameranej na praktické a aktuálne problémy. Cieľom projektu je preskúmať možnosti využitia Visual Transformerov pri analýze snímok a vytvoriť funkčné riešenie pre medicínsku prax. Aplikácia poskytuje jednoduché rozhranie, kde rádiológ nahrá snímku a dostane vizualizované výsledky s indikáciou rizikových oblastí. Môj model je optimalizovaný pre presné rozpoznávanie nádorových zmien a zároveň je zabezpečená anonymizácia citlivých údajov. Aplikácia má slúžiť ako podporný nástroj pre rádiológov, nie ako ich náhrada. Konkrétne ciele sú: jednoduché nahrávanie snímok, vyhodnotenie modelom, vizualizácia podozrivých oblastí a prehľadné výsledky. Projekt spája teoretické poznatky s praktickým nasadením a môže priniesť prínos pre medicínsku sféru aj ďalší výskum AI diagnostiky.

## Čo robí Mamography analyzer

- Základná administrácia používateľov (doktor, pacient, admin).
- Správa webinárov (CRUD).
- Správa testimonialov / doktorov (CRUD, upload fotky).
- Počas vývoja som ukladal fotky do DB ako base64 (stĺpec `image_data`) — jednoduché pre demo.

## Požiadavky

- PHP 8+ (alebo verzia, ktorú požaduje projekt).
- Composer.
- sqlite3 (repo obsahuje `database/database.sqlite` — najjednoduchšia voľba).

Ak chceš, môžeš použiť MySQL/Postgres — uprav `.env`.

## Inštalácia (Windows PowerShell)

1) Prejdi do projektu:

    ```powershell
    cd C:\Users\marpl\Desktop\Mamooo\mamographyAnalyzer
    ```

2) Nainštaluj závislosti:

    ```powershell
    composer install
    ```

3) Skopíruj `.env` a vygeneruj kľúč:

    ```powershell
    copy .env.example .env
    php artisan key:generate
    ```

4) SQLite: ak chýba, vytvor súbor databázy:

    ```powershell
    New-Item -Path database\database.sqlite -ItemType File
    ```

## Migrácie a seed

Spusti migrácie a (voliteľne) seedery:

```powershell
php artisan migrate --force
php artisan db:seed
```

Ak potrebuješ vrátiť poslednú migráciu:

```powershell
php artisan migrate:rollback --step=1
```

## Spustenie lokálne

```powershell
php artisan serve
# otvor: http://127.0.0.1:8000
```

## Admin

- Po seedovaní by mal existovať admin účet (ak to seeder robí). Ak nie, vytvor ho cez tinker alebo manuálne v DB.
- Skontroluj routy v `routes/web.php` (dashboard môže byť na `/dashboard` alebo inej ceste).

Príklad vytvorenia admina cez tinker:

```powershell
php artisan tinker --execute "\App\Models\User::create(['name'=>'Admin','email'=>'admin@example.com','password'=>bcrypt('heslo'), 'role'=>'admin']);"
```

## Obrázky

- Demo spracováva obrázky ako base64 v DB (`image_data`).
- Pre serióznejšie nasadenie odporúčam ukladať súbory na disk (`storage/app/public`) a v DB ukladať len cestu.

## Riešenie bežných problémov

- Nevidíš zmeny v `.env`? Skús:

    ```powershell
    php artisan config:clear
    php artisan cache:clear
    ```

- Problémy s právami (storage, bootstrap/cache) — na Linuxe rieš `chown`/`chmod`.
- Pri zmene DB skontroluj `DB_CONNECTION` v `.env`.

## Čo plánujem ďalej (možné vylepšenia)

- Presun uploadu obrázkov z DB na disk.
- Admin seeder, ak ešte chýba.
- Client-side náhľad pri nahrávaní fotky.

## Kontakt

Ak chceš, aby som niečo upravil alebo pomohol s nasadením — otvor issue alebo napíš (planieta4@stud.uniza.sk).


