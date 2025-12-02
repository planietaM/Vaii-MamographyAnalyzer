<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; // <-- PRIDAŤ

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        try {
            // Skúsi sa autentifikovať, v prípade zlyhania vyvolá ValidationException
            $request->authenticate();
        } catch (ValidationException $e) {
            // 🚨 KĽÚČOVÉ: Ak autentifikácia zlyhá, vrátime 401 Unauthorized JSON odpoveď
            return response()->json([
                'message' => 'Tieto prihlasovacie údaje nesúhlasia s našimi záznamami.',
                'errors' => $e->errors(),
            ], 401); // <--- Manuálne nastavenie statusu 401
        }

        // Ak je úspech (žiadna Exception):
        $user = Auth::user();
        $token = $user->createToken('auth-token')->plainTextToken;

        return response()->json([
            'message' => 'Login successful',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 200);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        // 1. Zrušíme webovú session (pre úplnosť, ale v API testoch zlyhá)
        Auth::guard('web')->logout();

        // 2. KĽÚČOVÁ ZMENA PRE API: Zrušíme aktuálny Sanctum token
        // Token je v tele požiadavky (request), ak je používateľ prihlásený.
        if ($request->user()) {
            // Zrušenie Iba aktuálneho tokenu, ktorý bol použitý na volanie tejto routy
            $request->user()->currentAccessToken()->delete();
        }

        // Tieto riadky, ktoré spôsobujú chybu "Session store not set", odstraňujeme:
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();

        // API odpoveď: 204 No Content (špecifický pre úspešné odhlásenie/vymazanie)
        return response()->noContent();
    }
}
