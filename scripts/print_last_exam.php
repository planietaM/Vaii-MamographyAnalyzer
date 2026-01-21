<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Examination;
use Illuminate\Support\Facades\Storage;

$exam = Examination::orderBy('id','desc')->first();
if (! $exam) {
    echo "No examinations found\n";
    exit(0);
}

echo "Exam id: {$exam->id}\n";
echo "photo (db): " . ($exam->photo ?? 'NULL') . "\n";

// Try to get photo_url via accessor if exists
$photoUrl = null;
try { $photoUrl = $exam->photo_url ?? null; } catch (Throwable $e) { $photoUrl = null; }
echo "photo_url (accessor): " . ($photoUrl ?? 'NULL') . "\n";

$storagePath = __DIR__ . '/../storage/app/public/' . ($exam->photo ?? '');
$publicPath = __DIR__ . '/../public/storage/' . ($exam->photo ?? '');

echo "expected storage path: $storagePath\n";
echo "expected public path: $publicPath\n";

echo 'storage file exists: ' . (file_exists($storagePath) ? 'YES' : 'NO') . "\n";
echo 'public file exists: ' . (file_exists($publicPath) ? 'YES' : 'NO') . "\n";

// If photo_url is null, construct potential URL
if (! $photoUrl && $exam->photo) {
    $appUrl = config('app.url') ?: 'http://localhost';
    $photoUrl = rtrim($appUrl, '/') . '/storage/' . ltrim($exam->photo, '/');
    echo "constructed photo_url: $photoUrl\n";
}

// print filesystem disk config
echo "FILESYSTEM_DISK: " . config('filesystems.default') . "\n";

// print permissions (if possible)
if (file_exists($storagePath)) {
    $perms = substr(sprintf('%o', fileperms($storagePath)), -4);
    echo "storage file perms: $perms\n";
}



