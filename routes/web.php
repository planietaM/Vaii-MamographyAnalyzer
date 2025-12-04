<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    return match ($role) {
        'patient' => view('pacient'),
        'doctor' => view('doktor'),
        'admin' => view('admin'),
        default => redirect()->route('login')->with('error', 'Neznáma rola.'),
    };
})->middleware('auth:sanctum')->name('dashboard'); // Zabezpečíme routu
