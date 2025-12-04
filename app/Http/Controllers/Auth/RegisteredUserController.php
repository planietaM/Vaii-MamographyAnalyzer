<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; // Pre API odpoveď
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Spracuje prichádzajúcu požiadavku registrácie (API).
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        // 1. Základná validácia (spoločné polia)
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'is_doctor' => ['required', 'boolean'], // Kľúčové pole z Front-endu
        ]);

        $isDoctor = $request->input('is_doctor');
        $role = $isDoctor ? 'doctor' : 'patient';

        // 2. Rozdelenie mena
        $fullName = explode(' ', $request->name, 2);
        $firstName = $fullName[0];
        $surname = $fullName[1] ?? null;

        // 3. Dynamická validácia pre Doktora/Pacienta
        $specificRules = $isDoctor
            ? [ // Pravidlá pre Doktora
                'dikter_id' => ['required', 'string', 'max:50', 'unique:'.User::class],
            ]
            : [ // Pravidlá pre Pacienta
                'rodne_cislo' => ['required', 'string', 'max:11', 'unique:'.User::class],
                'datum_narodenia' => ['required', 'date'],
                'pohlavie' => ['required', 'in:zena,muz'],
            ];

        $request->validate($specificRules);

        // 4. Vytvorenie používateľa
        $user = User::create([
            'name' => $firstName,
            'surname' => $surname,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
            'role' => $role,
            'phone' => $request->telefon ?? null,

            // Dáta pre Doktora
            'dikter_id' => $isDoctor ? $request->dikter_id : null,
            'specialization' => $isDoctor ? $request->specializacia : null,
            'workplace' => $isDoctor ? $request->pracovisko : null,

            // Dáta pre Pacienta
            'national_id' => !$isDoctor ? $request->rodne_cislo : null,
            'birth_date' => !$isDoctor ? $request->datum_narodenia : null,
            'gender' => !$isDoctor ? ($request->pohlavie === 'zena' ? 'female' : 'male') : null,
        ]);

        event(new Registered($user));

        // 5. API Odpoveď: 201 Created
        return response()->json([
            'message' => 'Registration successful.',
            'user_id' => $user->id,
        ], 201);
    }
}
