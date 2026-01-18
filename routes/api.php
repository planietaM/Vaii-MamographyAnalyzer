<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
require __DIR__.'/auth.php';

// Examinations API
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('patients/{patient}/examinations', [App\Http\Controllers\ExaminationController::class, 'indexForPatient']);
    Route::get('doctors/{doctor}/examinations', [App\Http\Controllers\ExaminationController::class, 'indexForDoctor']);
    Route::post('examinations', [App\Http\Controllers\ExaminationController::class, 'store']);
    Route::put('examinations/{examination}', [App\Http\Controllers\ExaminationController::class, 'update']);
});
