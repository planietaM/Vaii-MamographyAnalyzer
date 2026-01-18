<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Examination;

$doctor = User::where('role','doctor')->first();
$patient = User::where('role','patient')->first();

if (! $doctor || ! $patient) {
    echo "Need at least one doctor and one patient seeded.\n";
    exit(1);
}

$exam = Examination::create([
    'doctor_id' => $doctor->id,
    'patient_id' => $patient->id,
    'photo' => null,
    'result' => 'negative',
    'notes' => 'Test exam',
]);

echo "Created exam id={$exam->id} doctor={$doctor->id} patient={$patient->id}\n";

