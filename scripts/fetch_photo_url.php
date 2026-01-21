<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Examination;

$exam = Examination::orderBy('id','desc')->first();
if (! $exam) { echo "No exam\n"; exit; }

$photoUrl = $exam->photo_url ?? ('http://localhost/storage/' . $exam->photo);
echo "URL: $photoUrl\n";

$opts = [ 'http' => [ 'method' => 'GET', 'timeout' => 10 ] ];
$context = stream_context_create($opts);

// try to fetch headers
$headers = @get_headers($photoUrl);
if ($headers === false) {
    echo "GET headers failed\n";
} else {
    echo "Headers:\n";
    foreach ($headers as $h) echo $h . "\n";
}

// try to fetch content length
$content = @file_get_contents($photoUrl, false, $context);
if ($content === false) {
    echo "GET content failed (file_get_contents)\n";
} else {
    echo "Fetched content length: " . strlen($content) . " bytes\n";
}

