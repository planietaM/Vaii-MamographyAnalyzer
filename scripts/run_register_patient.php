<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisteredUserController;

$payload = [
    'name' => 'Miso Kucka',
    'email' => 'miso.kucka+test@example.com',
    'password' => 'password',
    'password_confirmation' => 'password',
    'is_doctor' => false,
    'rodne_cislo' => '035489/6214',
    'datum_narodenia' => '2001-12-10',
    'telefon' => '+421901234567'
];

$request = Request::create('/api/register', 'POST', $payload);
$app->instance('request', $request);
$controller = new RegisteredUserController();
try {
    $resp = $controller->store($request);
    if (is_object($resp)) {
        echo "STATUS: " . $resp->getStatusCode() . PHP_EOL;
        echo (string)$resp->getContent() . PHP_EOL;
    } else {
        var_export($resp);
    }
} catch (\Throwable $e) {
    echo 'EXCEPTION: ' . get_class($e) . '\nMessage: ' . $e->getMessage() . '\nTrace:\n' . $e->getTraceAsString() . PHP_EOL;
}

