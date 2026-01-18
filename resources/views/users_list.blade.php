<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <title>Používatelia</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <style>
        body{font-family: Arial, Helvetica, sans-serif; padding:20px}
        h2{margin-top:24px}
        table{width:100%;border-collapse:collapse}
        th,td{border:1px solid #ddd;padding:8px;text-align:left}
        th{background:#f3f3f3}
        .alert{padding:12px;border-radius:4px;margin-bottom:16px}
        .alert-error{background:#fdecea;color:#611a15;border:1px solid #f5c6cb}
        .alert-success{background:#e6ffed;color:#0b5f2b;border:1px solid #c6f6d5}
        .actions{margin-bottom:16px}
        .btn{display:inline-block;padding:8px 12px;border-radius:4px;text-decoration:none;color:#fff;background:#007bff}
        .btn-secondary{background:#6c757d}
    </style>
</head>
<body>

    <h1>Prehľad používateľov</h1>

    <div class="actions">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Späť</a>
        <a href="{{ url()->current() }}" class="btn">Obnoviť</a>
    </div>

    @if(session('error'))
        <div class="alert alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <h2>Admini ({{ isset($admins) ? $admins->count() : 0 }})</h2>
    @isset($admins)
        @forelse($admins as $u)
            @if($loop->first)
                <table>
                    <tr><th>ID</th><th>Meno</th><th>Email</th><th>Telefon</th></tr>
            @endif
                <tr>
                    <td>{{ $u->id ?? '-' }}</td>
                    <td>{{ trim(($u->name ?? '') . ' ' . ($u->surname ?? '')) ?: '-' }}</td>
                    <td>{{ $u->email ?? '-' }}</td>
                    <td>{{ $u->phone ?? '-' }}</td>
                </tr>
            @if($loop->last)
                </table>
            @endif
        @empty
            <p>Žiadni admini.</p>
        @endforelse
    @else
        <p>Žiadni admini.</p>
    @endisset

    <h2>Lekári ({{ isset($doctors) ? $doctors->count() : 0 }})</h2>
    @isset($doctors)
        @forelse($doctors as $u)
            @if($loop->first)
                <table>
                    <tr><th>ID</th><th>Meno</th><th>Email</th><th>Dikter ID</th><th>Špecializácia</th></tr>
            @endif
                <tr>
                    <td>{{ $u->id ?? '-' }}</td>
                    <td>{{ trim(($u->name ?? '') . ' ' . ($u->surname ?? '')) ?: '-' }}</td>
                    <td>{{ $u->email ?? '-' }}</td>
                    <td>{{ $u->dikter_id ?? '-' }}</td>
                    <td>{{ $u->specialization ?? '-' }}</td>
                </tr>
            @if($loop->last)
                </table>
            @endif
        @empty
            <p>Žiadni lekári.</p>
        @endforelse
    @else
        <p>Žiadni lekári.</p>
    @endisset

    <h2>Pacienti ({{ isset($patients) ? $patients->count() : 0 }})</h2>
    @isset($patients)
        @forelse($patients as $u)
            @if($loop->first)
                <table>
                    <tr><th>ID</th><th>Meno</th><th>Email</th><th>Rodné číslo</th><th>Dátum narodenia</th></tr>
            @endif
                <tr>
                    <td>{{ $u->id ?? '-' }}</td>
                    <td>{{ trim(($u->name ?? '') . ' ' . ($u->surname ?? '')) ?: '-' }}</td>
                    <td>{{ $u->email ?? '-' }}</td>
                    <td>{{ $u->national_id ?? '-' }}</td>
                    <td>{{ $u->birth_date ?? '-' }}</td>
                </tr>
            @if($loop->last)
                </table>
            @endif
        @empty
            <p>Žiadni pacienti.</p>
        @endforelse
    @else
        <p>Žiadni pacienti.</p>
    @endisset

</body>
</html>
