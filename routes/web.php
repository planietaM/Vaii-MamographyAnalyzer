<?php

use Illuminate\Support\Facades\Route;

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
