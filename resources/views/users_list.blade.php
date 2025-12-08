<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <title>Používatelia</title>
    <style>
        body{font-family: Arial, Helvetica, sans-serif; padding:20px}
        h2{margin-top:24px}
        table{width:100%;border-collapse:collapse}
        th,td{border:1px solid #ddd;padding:8px;text-align:left}
        th{background:#f3f3f3}
    </style>
</head>
<body>
    <h1>Prehľad používateľov</h1>

    <h2>Admini ({{ $admins->count() }})</h2>
    @if($admins->isEmpty())
        <p>Žiadni admini.</p>
    @else
        <table>
            <tr><th>ID</th><th>Meno</th><th>Email</th><th>Telefon</th></tr>
            @foreach($admins as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }} {{ $u->surname }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->phone }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <h2>Lekári ({{ $doctors->count() }})</h2>
    @if($doctors->isEmpty())
        <p>Žiadni lekári.</p>
    @else
        <table>
            <tr><th>ID</th><th>Meno</th><th>Email</th><th>Dikter ID</th><th>Špecializácia</th></tr>
            @foreach($doctors as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }} {{ $u->surname }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->dikter_id }}</td>
                    <td>{{ $u->specialization }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <h2>Pacienti ({{ $patients->count() }})</h2>
    @if($patients->isEmpty())
        <p>Žiadni pacienti.</p>
    @else
        <table>
            <tr><th>ID</th><th>Meno</th><th>Email</th><th>Rodné číslo</th><th>Dátum narodenia</th></tr>
            @foreach($patients as $u)
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name }} {{ $u->surname }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->national_id }}</td>
                    <td>{{ $u->birth_date }}</td>
                </tr>
            @endforeach
        </table>
    @endif

</body>
</html>
