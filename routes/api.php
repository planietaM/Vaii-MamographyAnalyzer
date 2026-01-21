<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Get user by ID (for patient validation)
Route::middleware(['auth:sanctum'])->get('/users/{user}', function ($userId) {
    $user = \App\Models\User::find($userId);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }
    return response()->json($user);
});

require __DIR__.'/auth.php';

// Examinations API
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('patients/{patient}/examinations', [App\Http\Controllers\ExaminationController::class, 'indexForPatient']);
    Route::get('doctors/{doctor}/examinations', [App\Http\Controllers\ExaminationController::class, 'indexForDoctor']);
    Route::get('examinations/{examination}', [App\Http\Controllers\ExaminationController::class, 'show']);
    Route::post('examinations', [App\Http\Controllers\ExaminationController::class, 'store']);
    Route::put('examinations/{examination}', [App\Http\Controllers\ExaminationController::class, 'update']);
    Route::delete('examinations/{examination}', [App\Http\Controllers\ExaminationController::class, 'destroy']);
});
