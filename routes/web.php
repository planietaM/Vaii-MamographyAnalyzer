<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/prihlasenie', function () {
    return view('prihlasenie');
})->name('login');

Route::post('/prihlasenie', function () {
    // Tu by bola logika na prihlásenie
    return redirect()->route('home');
})->name('login.submit');

Route::get('/registracia', function () {
    return view('zaregistrujSa');
})->name('register');
