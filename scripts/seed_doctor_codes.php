<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;

$codes = ['000000','111111','222222','333333','444444','555555','666666','777777','888888','999999'];
foreach ($codes as $c) {
    $exists = DB::table('doctor_codes')->where('code', $c)->exists();
    if (! $exists) {
        DB::table('doctor_codes')->insert(['code' => $c, 'created_at' => now(), 'updated_at' => now()]);
        echo "inserted $c\n";
    } else {
        echo "exists $c\n";
    }
}
