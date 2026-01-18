<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Models\User;

$doctors = User::where('role', 'doctor')->get();
$patients = User::where('role', 'patient')->get();
$admin = User::where('role', 'admin')->first();

echo "Admin: " . ($admin ? $admin->email : 'none') . PHP_EOL;
echo "Doctors: " . $doctors->count() . PHP_EOL;
foreach ($doctors as $d) {
    echo " - {$d->name} | {$d->email} | phone=".($d->phone ?? '-') . " | dikter_id=".($d->dikter_id ?? '-') . PHP_EOL;
}

echo "Patients: " . $patients->count() . PHP_EOL;
foreach ($patients as $p) {
    echo " - {$p->name} {$p->surname} | {$p->email} | phone=".($p->phone ?? '-') . " | national_id=".($p->national_id ?? '-') . " | birth_date=".($p->birth_date ?? '-') . PHP_EOL;
}

