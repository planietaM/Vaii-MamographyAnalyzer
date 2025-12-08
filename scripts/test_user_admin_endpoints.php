<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$kernel->bootstrap();

use App\Http\Controllers\UserAdminController;
use App\Models\User;
use Illuminate\Http\Request;

$controller = new UserAdminController();

// pick a user to test
$user = User::first();
if (! $user) {
    echo "No users in database to test.\n";
    exit(1);
}

echo "Testing show() for user id={$user->id}\n";
$resp = $controller->show($user);
echo "show response status: " . $resp->getStatusCode() . "\n";
echo substr((string)$resp->getContent(), 0, 400) . "\n\n";

// test update (flip name temporarily)
$originalName = $user->name;
$payload = ['name' => $originalName . '_x', 'surname' => $user->surname, 'email' => $user->email];
$request = Request::create('/admin/users/'.$user->id, 'PUT', $payload);

echo "Testing update() for user id={$user->id}\n";
$resp = $controller->update($request, $user);
echo "update response: " . substr((string)$resp->getContent(), 0, 400) . "\n";

// revert name back
$user->name = $originalName;
$user->save();

// test destroy: create a temporary user then delete
$tmp = User::create([
    'name' => 'tmp-user',
    'email' => 'tmp-' . time() . '@example.com',
    'password' => bcrypt('password'),
    'role' => 'patient'
]);

echo "Testing destroy() for tmp id={$tmp->id}\n";
$resp = $controller->destroy($tmp);
echo "destroy response: " . substr((string)$resp->getContent(), 0, 400) . "\n";

// confirm deleted
$found = User::find($tmp->id);
echo "tmp found after delete? " . ($found ? 'yes' : 'no') . "\n";

