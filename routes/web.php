<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserListController;
use App\Models\User;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
})->name('home');

// TÁTO RÚTA ZOBRAZÍ PRIHLÁSENIE:
Route::get('/prihlasenie', function () {
    return view('prihlasenie');
})->name('login');

// TÁTO RÚTA ZOBRAZÍ REGISTRÁCIU:
Route::get('/registracia', function () {
    return view('zaregistrujSa');
})->name('register');


Route::get('/dashboard', function () {
    // 1. Kontrola, či je používateľ vôbec prihlásený/validovaný tokenom
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    // 2. Získanie roly
    $role = Auth::user()->role;

    // 3. Vrátenie správneho pohľadu (Blade súboru)
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
        default => redirect()->route('login')->with('error', 'Neznáma rola.'),
    };
})->middleware('auth')->name('dashboard'); // Zabezpečíme routu (session-based auth for web)

Route::get('/users', [UserListController::class, 'index'])->name('users.list');

// Admin user management (AJAX endpoints)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('users/{user}', [App\Http\Controllers\UserAdminController::class, 'show'])->name('admin.users.show');
    Route::put('users/{user}', [App\Http\Controllers\UserAdminController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [App\Http\Controllers\UserAdminController::class, 'destroy'])->name('admin.users.destroy');

    // Examination management for doctors (web endpoints that return JSON)
    Route::post('examinations', [App\Http\Controllers\ExaminationController::class, 'store'])->name('admin.examinations.store');
    Route::put('examinations/{examination}', [App\Http\Controllers\ExaminationController::class, 'update'])->name('admin.examinations.update');
    Route::get('examinations/{examination}', [App\Http\Controllers\ExaminationController::class, 'show'])->name('admin.examinations.show');
    Route::delete('examinations/{examination}', [App\Http\Controllers\ExaminationController::class, 'destroy'])->name('admin.examinations.destroy');

    // web endpoints for listing examinations (session-authenticated)
    Route::get('patients/{patient}/examinations', [App\Http\Controllers\ExaminationController::class, 'indexForPatient'])->name('admin.patients.examinations.index');
    Route::get('doctors/{doctor}/examinations', [App\Http\Controllers\ExaminationController::class, 'indexForDoctor'])->name('admin.doctors.examinations.index');
});

// Fallback web login route (non-AJAX) — helps when API/Axios fails
Route::post('/web-login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect('/dashboard');
    }

    return redirect('/prihlasenie')->withErrors(['email' => 'Tieto prihlasovacie údaje nesúhlasia s našimi záznamami.']);
})->name('web.login');
