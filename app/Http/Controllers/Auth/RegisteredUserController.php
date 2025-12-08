<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse; // Pre API odpoveď
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Validator;

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

        // --- Normalize incoming rodne_cislo so both formats "035489/6214" and "0354896214" work
        if ($request->has('rodne_cislo')) {
            $normalized = preg_replace('/\D+/', '', (string)$request->input('rodne_cislo'));
            // keep original key for front-end, but replace value with normalized digits
            $request->merge(['rodne_cislo' => $normalized]);
        }

        // 3. Dynamická validácia pre Doktora/Pacienta
        $specificRules = $isDoctor
            ? [ // Pravidlá pre Doktora
                // dikter_id must be exactly 6 digits and must exist in doctor_codes table
                'dikter_id' => ['required', 'string', 'regex:/^\d{6}$/', 'exists:doctor_codes,code', 'unique:users,dikter_id'],
            ]
            : [ // Pravidlá pre Pacienta
                // validate incoming field name 'rodne_cislo' but check uniqueness against users.national_id
                'rodne_cislo' => ['required', 'string', 'max:11', 'unique:users,national_id'],
                'datum_narodenia' => ['required', 'date'],
            ];

        // Použijeme Validator aby sme mohli poskytnúť vlastné správy pre chyby
        $validator = Validator::make($request->all(), $specificRules, [
            'dikter_id.exists' => 'Zadané Dikter ID nie je platné. Skontrolujte kód alebo kontaktujte administrátora.',
            'dikter_id.required' => 'Dikter ID je povinné pre registráciu lekára.',
            'dikter_id.regex' => 'Dikter ID musí byť práve 6 číslic (napr. 000000).',
            'dikter_id.unique' => 'Toto Dikter ID už je priradené inému účtu.',
            'rodne_cislo.unique' => 'Toto rodné číslo už existuje v systéme.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // 4. Vytvorenie používateľa
        $user = new User();
        $user->name = $firstName;
        $user->surname = $surname;
        $user->email = $request->email;
        $user->password = Hash::make($request->string('password'));
        $user->role = $role;
        $user->phone = $request->telefon ?? null;

        // Dáta pre Doktora
        if ($isDoctor) {
            $user->dikter_id = $request->dikter_id;
            $user->specialization = $request->specializacia;
            $user->workplace = $request->pracovisko;
        }

        // Dáta pre Pacienta
        if (! $isDoctor) {
            // we normalized rodne_cislo earlier (digits only) and store into DB column `national_id`
            $user->national_id = $request->rodne_cislo;
            $user->birth_date = $request->datum_narodenia;
        }

        $user->save();

        event(new Registered($user));

        // 5. API Odpoveď: 201 Created
        return response()->json([
            'message' => 'Registration successful.',
            'user_id' => $user->id,
        ], 201);
    }
}
