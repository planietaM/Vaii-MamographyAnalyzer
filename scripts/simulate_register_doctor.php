<?php
// Script to simulate calling RegisteredUserController@store without HTTP server
require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\RegisteredUserController;

// Create a request payload for a doctor
$payload = [
    'name' => 'Dr Test',
    'email' => 'drtest@example.com',
    'password' => 'password',
    'password_confirmation' => 'password',
    'is_doctor' => true,
    'dikter_id' => '000000',
    'specializacia' => 'radiologia',
];

// Boot the framework minimally
$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Prepare Request
$request = Request::create('/api/register', 'POST', $payload);

// Bind the request to the container (so validation and facades work)
$app->instance('request', $request);

$controller = new RegisteredUserController();
try {
    $response = $controller->store($request);
    echo (string) $response->getContent() . PHP_EOL;
} catch (Exception $e) {
    echo 'EXCEPTION: ' . $e->getMessage() . PHP_EOL;
}

