<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Models\Examination;
use App\Models\User;

$exam = Examination::with(['doctor','patient'])->first();
if (! $exam) {
    echo "No examinations found\n";
    exit;
}

echo "Exam id={$exam->id} doctor={$exam->doctor->email} patient={$exam->patient->email} photo={$exam->photo} result={$exam->result}\n";

$doctor = User::where('role','doctor')->first();
$patient = User::where('role','patient')->first();

echo "Doctor exams: " . $doctor->doctorExaminations()->count() . "\n";
echo "Patient exams: " . $patient->patientExaminations()->count() . "\n";

