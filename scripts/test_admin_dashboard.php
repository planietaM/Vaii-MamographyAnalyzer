<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

// Find an admin user
$admin = User::where('role', 'admin')->first();
if (! $admin) {
    echo "No admin user found in database. Create one and retry.\n";
    exit(1);
}

// Create a Request and bind it to the container before using Auth
$request = Request::create('/dashboard', 'GET');
$app->instance('request', $request);

// Log in as that user for the request
Auth::login($admin);

$response = $app->handle($request);

echo "STATUS: " . $response->getStatusCode() . "\n";
echo substr((string)$response->getContent(), 0, 2000) . "\n"; // print start of content
