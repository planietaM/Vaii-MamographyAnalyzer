<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException; // <-- PRIDAŤ
use Laravel\Sanctum\PersonalAccessToken; // <-- PRIDAŤ
use Illuminate\Support\Facades\Log; // <-- PRIDAŤ

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        // Log invocation for debugging (do NOT log passwords)
        try {
            Log::info('Login attempt', [
                'email' => $request->input('email'),
                'has_cookie' => $request->cookies->count() > 0,
                'headers' => [
                    'authorization' => $request->header('Authorization'),
                    'content-type' => $request->header('Content-Type'),
                ],
            ]);
        } catch (\Throwable $e) {
            // swallow logging errors
        }

        try {
            // Skúsi sa autentifikovať, v prípade zlyhania vyvolá ValidationException
            $request->authenticate();
        } catch (ValidationException $e) {
            // Log failure reason
            Log::warning('Login validation failed', ['errors' => $e->errors(), 'email' => $request->input('email')]);
            // 🚨 KĽÚČOVÉ: Ak autentifikácia zlyhá, vrátime 401 Unauthorized JSON odpoveď
            return response()->json([
                'message' => 'Tieto prihlasovacie údaje nesúhlasia s našimi záznamami.',
                'errors' => $e->errors(),
            ], 401); // <--- Manuálne nastavenie statusu 401
        }

        // Ak je úspech (žiadna Exception):
        // Try to resolve the authenticated user from the guard; if guard didn't set it for some reason
        // (API contexts, guard mismatch), fall back to loading by email so we always return a stable payload.
        $user = Auth::user();
        if (! $user) {
            $email = $request->input('email');
            $user = \App\Models\User::where('email', $email)->first();
        }

        if (! $user) {
            Log::error('Authenticated but user record not found', ['email' => $request->input('email')]);
            // This should not happen after successful authenticate(), but be defensive and return 500
            return response()->json(['message' => 'Authenticated but user record cannot be resolved.'], 500);
        }

        $token = $user->createToken('auth-token')->plainTextToken;

        // Log success with user id (no sensitive data)
        Log::info('Login successful', ['user_id' => $user->id]);

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
        // Log logout attempt
        try {
            Log::info('Logout attempt', [
                'auth_header' => $request->header('Authorization'),
                'has_cookie' => $request->cookies->count() > 0,
                'user_resolved' => $request->user() ? $request->user()->id : null,
            ]);
        } catch (\Throwable $e) {
            // ignore
        }

        // 1. Zrušíme webovú session (pre úplnosť)
        try {
            Auth::guard('web')->logout();
            // Also call default logout to cover other guards used in tests
            Auth::logout();
        } catch (\Exception $e) {
            // ignore
        }

        // Attempt to invalidate and regenerate session safely (may not exist in API context)
        try {
            if (method_exists($request, 'session') && $request->session()) {
                $request->session()->invalidate();
                $request->session()->regenerateToken();
            }
        } catch (\Throwable $e) {
            // ignore session store missing errors
        }

        // 2. Pokúsime sa zrušiť token explicite, ak existuje v hlavičke Authorization
        $authHeader = $request->header('Authorization') ?? '';
        if (strpos($authHeader, 'Bearer ') === 0) {
            $token = substr($authHeader, 7);
            if ($token) {
                try {
                    $pat = PersonalAccessToken::findToken($token);
                    if ($pat) {
                        // Avoid calling delete() on transient token objects (they don't implement delete)
                        if (method_exists($pat, 'delete')) {
                            $pat->delete();
                        } else {
                            Log::info('Found transient token; nothing to delete for bearer token');
                        }
                    }
                } catch (\Exception $e) {
                    // ignore token delete errors
                    Log::warning('Error while attempting to delete token', ['err' => $e->getMessage()]);
                }
            }
        }

        // If a user is resolved by the request (e.g., sanctum middleware set it), delete currentAccessToken
        if ($request->user() && method_exists($request->user(), 'currentAccessToken')) {
            try {
                $request->user()->currentAccessToken()?->delete();
            } catch (\Exception $e) {
                // ignore
            }
        }

        return response()->noContent();
    }
}
