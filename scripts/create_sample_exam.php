<?php
// usage: php scripts/create_sample_exam.php
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Examination;
use Illuminate\Support\Facades\Storage;

// find a doctor and a patient created by seeders
$doctor = User::where('email', 'doctor1@mammo.sk')->first();
$patient = User::where('email', 'user1@example.com')->first();

if (! $doctor || ! $patient) {
    echo "Doctor or patient not found. Make sure seeders ran.\n";
    exit(1);
}

// ensure storage path exists
$publicDir = __DIR__ . '/../public';
$source = $publicDir . '/images/mammo1.png';
if (! file_exists($source)) {
    // try any image in public/images
    $files = glob($publicDir . '/images/*.{png,jpg,jpeg}', GLOB_BRACE);
    $source = $files[0] ?? null;
}
if (! $source) {
    echo "No source image found in public/images to copy.\n";
    exit(1);
}

$destName = 'examinations/sample_' . time() . '_' . basename($source);
$destPath = storage_path('app/public/' . $destName);
@mkdir(dirname($destPath), 0777, true);
if (! copy($source, $destPath)) {
    echo "Failed to copy image to storage.\n";
    exit(1);
}

// create exam
$exam = Examination::create([
    'doctor_id' => $doctor->id,
    'patient_id' => $patient->id,
    'photo' => $destName,
    'result' => 'negative',
    'notes' => 'Sample exam created for testing',
]);

// ensure photo_url accessor works
$photoUrl = $exam->photo_url ?? Storage::disk('public')->url($destName);

echo "Created exam id={$exam->id} patient={$patient->email} doctor={$doctor->email}\n";
echo "photo: {$exam->photo}\n";
echo "photo_url: {$photoUrl}\n";

// show JSON of what API would return
$apiItem = [
    'id' => $exam->id,
    'created_at' => $exam->created_at->toDateTimeString(),
    'result' => $exam->result,
    'notes' => $exam->notes,
    'photo_url' => $photoUrl,
    'doctor' => [ 'id' => $doctor->id, 'name' => $doctor->name, 'surname' => $doctor->surname ],
];

echo "API item:\n" . json_encode($apiItem, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n";

