<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
$rows = DB::table('doctor_codes')->orderBy('code')->pluck('code')->toArray();
echo json_encode($rows, JSON_PRETTY_PRINT) . PHP_EOL;
