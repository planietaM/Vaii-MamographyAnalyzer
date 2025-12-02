<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_users_can_register(): void
    {
        $userData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            // Pre zjednodušenie testu na najmenší možný prípad (Pacient)
            'is_doctor' => false, // Váš Front-end posiela toto!
            'rodne_cislo' => '123456/7890',
            'datum_narodenia' => '1990-01-01',
            'pohlavie' => 'muz',
        ];

        // ✅ Oprava Routy: Voláme /api/register
        $response = $this->post('/api/register', $userData);

        // ✅ Oprava Status Kódu: Registrácia v API má vracať 201 Created
        $response->assertStatus(201);

        // ✅ Oprava Asertácie: API registrácia neautentifikuje. Kontrolujeme DB.
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);

        // ❌ Odstránili sme: $this->assertAuthenticated();
        // ❌ Odstránili sme: $response->assertNoContent();
    }
}
