<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserListController;
use App\Models\User;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/o-nas', function () {
    return view('o-nas');
})->name('o-nas');

Route::get('/skrining-rakoviny', function () {
    return view('skrining');
})->name('skrining');

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

        // Počet všetkých vyšetrení z databázy examinations
        $analysesCount = \App\Models\Examination::count();

        // Počet vyšetrení vykonaných dnes
        $todayCount = \App\Models\Examination::whereDate('created_at', today())->count();

        $doctors = User::where('role', 'doctor')->orderBy('id')->get();

        // Načítaj pacientov s ich posledným vyšetrením
        $patients = User::where('role', 'patient')->orderBy('id')->get()->map(function($patient) {
            // Nájdi posledné vyšetrenie pacienta
            $lastExam = \App\Models\Examination::where('patient_id', $patient->id)
                ->orderBy('created_at', 'desc')
                ->first();

            // Pridaj dátum posledného vyšetrenia k pacientovi
            $patient->last_exam_date = $lastExam ? $lastExam->created_at->format('d.m.Y') : null;

            return $patient;
        });

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
