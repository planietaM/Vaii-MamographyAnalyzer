<?php
require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Http\Request;

// Create a request and bind it to the container before bootstrapping
$req = Request::capture();

$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->instance('request', $req);
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\UserAdminController;
use App\Models\User;

$controller = new UserAdminController();

// pick a patient user to test
$user = User::where('role','patient')->first();
if (! $user) {
    echo "No patient users in database to test.\n";
    exit(1);
}

echo "Before update: id={$user->id} phone={$user->phone}\n";

// change only last digit of phone (if exists)
$phone = $user->phone ?? '';
if ($phone === '') {
    $newPhone = '+421900000000';
} else {
    // try to change the last digit
    $last = substr($phone, -1);
    if (!is_numeric($last)) {
        // replace non-digit with 1
        $newPhone = substr($phone, 0, -1) . '1';
    } else {
        $newDigit = ($last + 1) % 10;
        $newPhone = substr($phone, 0, -1) . $newDigit;
    }
}

$payload = ['name' => $user->name, 'surname' => $user->surname, 'email' => $user->email, 'phone' => $newPhone, 'dikter_id' => $user->dikter_id];

$request = Request::create('/admin/users/'.$user->id, 'PUT', $payload);

try {
    $resp = $controller->update($request, $user);
    echo "Update response: " . substr((string)$resp->getContent(),0,1000) . "\n";
} catch (Exception $e) {
    echo "Exception during update: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}

// reload user from DB
$user = User::find($user->id);
echo "After update: id={$user->id} phone={$user->phone}\n";

