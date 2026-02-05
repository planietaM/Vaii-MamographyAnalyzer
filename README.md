# Mamography Analyzer

Krátky popis

Tento projekt je jednoduché webové demo pre "Mamography Analyzer" — nástroj na podporu mamografického skríningu s admin rozhraním na správu doktorov (testimonialov) a webinárov.

Hlavné funkcie

- Správa používateľov (doktor, pacient, admin) cez admin dashboard.
- CRUD webinárov (názov, stručný text, dátum, miesto, telefón) — bez obrázkov.
- CRUD testimonialov / doktorov (meno, rola, text, nahratie fotky z PC). Fotky sa ukladajú do DB ako `image_data` (data URL).
- Jednoduchá stránka s úvodom a sekciou "Najbližšie webináre" a karuselom testimonialov.

Rýchle inštrukcie na spustenie (lokálne)

Požiadavky

- PHP 8+ (alebo verzia ktorá používa projekt)
- Composer
- sqlite3 (projekt používa sqlite v repozitári ako jednoduché DB) — ak nepoužívate sqlite, upravte `.env`

Inštalácia závislostí

```powershell
cd C:\Users\marpl\Desktop\Mamooo\mamographyAnalyzer
composer install
```

Vytvorenie env (ak chýba)

```powershell
copy .env.example .env
php artisan key:generate
```

DB (SQLite) — ak používate sqlite: skontrolujte `database/database.sqlite` alebo vytvorte nový súbor.

Migrácie a seedery

Aplikujte migrácie a seedery (v prostredí vývoja):

```powershell
php artisan migrate --force
php artisan db:seed
```

Poznámka: počas vývoja som pridal/a niekoľko migrácií:
- Pridané `image_data` pre `testimonials` (ukladanie base64 data-URI).
- Odstránené textové pole `image` (cesta) z `testimonials`.
- Odstránené obrázkové polia z `webinars` (webináre už nemajú obrázky).
- Nakoniec som odstránil stĺpec `active` z `testimonials` (UI ho už nepoužíva).

Ak potrebujete vrátiť migrácie späť (rollback):

```powershell
php artisan migrate:rollback --step=1
```

Spustenie lokálneho vývoja

```powershell
php artisan serve
# otvoríte http://127.0.0.1:8000 alebo adresu, ktorú servíruje artisan
```

Admin dashboard

- Prihláste sa ako admin (ak seed vytvorí admin používateľa) alebo vytvorte používateľa s rolou `admin`.
- Otvorte `/dashboard` — tam je sekcia `Testimonialy / Doktori` a `Webináre`.
- Testimonial modal umožňuje nahratie fotky (input `type=file`). Obrázok sa uloží do DB ako base64 `image_data` a hneď sa zobrazí v tabuľke.

Poznámky k tomu, ako som upravil správanie testimonialov:

- UI už neprijíma textovú cestu k obrázku (pole `image` bolo odstránené). Nahrávajte obrázky cez file input.
- Ak chcete nahrávať obrázky namiesto ukladania do DB (odporúča sa pri veľkých súboroch), môžem presunúť ukladanie do `storage/app/public` a ukladať len cestu v DB.

Frontend / AJAX

- Admin šablóna obsahuje JS, ktorý používa `axios` na CRUD volania pre `webinars` a `testimonials`.
- Na admin stránke som pridal server-side fallback: testimonialy sa vykreslia priamo z Blade (ak sú v premennej `$testimonials`), takže aj keď AJAX zlyhá, uvidíte údaje z DB.

Testovanie

- Rýchla kontrola v tinker (príklady):

```powershell
php artisan tinker --execute "print_r(\DB::table('testimonials')->first());"
```

Často kladené otázky / tipy

- Prečo sú obrázky uložené ako base64 v DB? — Je to rýchle riešenie počas vývoja. Pre produkciu odporúčam uložiť súbory na disk a v DB ukladať len cestu.
- Ako pridať nový webinár? — Admin dashboard → Webináre → Pridať webinár.
- Ako zmeniť zobrazovanie testimonialov na homepage? — `resources/views/home.blade.php` zobrazuje testimonialy podľa `Testimonial::orderBy('position')`.

Kontakt

Ak chceš ďalšie zlepšenia (preview obrázku pri nahrávaní, presun ukladania obrázkov na disk, vylepšenie štýlov), napíš, čo preferuješ a implementujem to.

---

Malé zhrnutie: upravil/a som admin UI tak, aby testimonialy boli čerpané z DB a aby sa nahrávala fotka cez file input; taktiež som urobil/a migrácie na odstránenie starých polí (image, active) a pridal/a pole `image_data` pre bezpečné zobrazovanie uploadov.
