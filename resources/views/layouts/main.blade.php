<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mamography Analyzer')</title>

    {{-- SEM IDE TVOJ CSS SÚBOR --}}
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>

<header>
    <div class="container nav">
        <ul class="nav-links">
            <li><a href="/">Domov</a></li>
            <li><a href="{{ route('skrining') }}">Skríning rakoviny</a></li>
            <li><a href="#">Pacienti</a></li>
            <li><a href="{{ route('o-nas') }}">O nás</a></li>
            <li><a href="#">Partneri</a></li>
            <li><a href="{{ route('users.list') }}">Kontaktujte nás</a></li>
        </ul>

        <a href="/prihlasenie" class="btn-primary">Prihlásenie</a>
    </div>
</header>

<main class="container">
    @yield('content')
</main>

@yield('scripts')

</body>
</html>
