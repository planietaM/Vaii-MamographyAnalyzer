<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\UserListController;
use App\Models\User;

Route::get('/', function () {
    return view('home');
});

// Static "About us" page used in Blade (route name 'o-nas')
Route::view('/o-nas', 'o-nas')->name('o-nas');

// Named route 'skrining' used in blade templates
Route::get('/skrining-rakoviny', function () {
    return view('skrining');
})->name('skrining');

// Route that shows the login page (web route used by your blade)
Route::get('/prihlasenie', function () {
    return view('prihlasenie');
})->name('login');

// Route that shows the registration page
Route::get('/registracia', function () {
    return view('zaregistrujSa');
})->name('register');

// Fallback web login route (non-AJAX) — helps when API/Axios fails
Route::post('/web-login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/dashboard');
    }

    return redirect('/prihlasenie')->withErrors(['email' => 'Tieto prihlasovacie údaje nesúhlasia s našimi záznamami.']);
})->name('web.login');

// Dashboard route that redirects to different blades based on authenticated user's role
Route::get('/dashboard', function () {
    $role = Auth::user()->role;

    if ($role === 'admin') {
        // Prepare DB-driven data for admin dashboard and return view directly
        $doctorsCount = User::where('role', 'doctor')->count();
        $patientsCount = User::where('role', 'patient')->count();
        // 'analyses' data not available in schema; keep 0 as placeholder
        $analysesCount = 0;
        $todayCount = 0;

        $doctors = User::where('role', 'doctor')->orderBy('id')->get();
        $patients = User::where('role', 'patient')->orderBy('id')->get();

        return view('admin', [
            'doctorsCount' => $doctorsCount,
            'patientsCount' => $patientsCount,
            'analysesCount' => $analysesCount,
            'todayCount' => $todayCount,
            'doctors' => $doctors,
            'patients' => $patients,
        ]);
    }

    return match ($role) {
        'patient' => view('pacient'),
        'doctor' => view('doktor'),
        'admin' => view('admin'),
        default => redirect()->route('login')->with('error', 'Neznáma rola.'),
    };
})->middleware('auth:sanctum')->name('dashboard'); // Zabezpečíme routu

Route::get('/users', [UserListController::class, 'index'])->name('users.list');

// Admin user management (AJAX endpoints)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('users/{user}', [App\Http\Controllers\UserAdminController::class, 'show'])->name('admin.users.show');
    Route::put('users/{user}', [App\Http\Controllers\UserAdminController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [App\Http\Controllers\UserAdminController::class, 'destroy'])->name('admin.users.destroy');
});

