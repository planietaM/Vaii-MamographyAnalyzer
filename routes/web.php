<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserListController;
use App\Models\User;

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
})->middleware('auth:sanctum')->name('dashboard'); // Zabezpečíme routu

Route::get('/users', [UserListController::class, 'index'])->name('users.list');

// Admin user management (AJAX endpoints)
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('users/{user}', [App\Http\Controllers\UserAdminController::class, 'show'])->name('admin.users.show');
    Route::put('users/{user}', [App\Http\Controllers\UserAdminController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [App\Http\Controllers\UserAdminController::class, 'destroy'])->name('admin.users.destroy');
});
