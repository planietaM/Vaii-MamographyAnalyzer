<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Testuje úspešné prihlásenie a overenie, či bol vrátený token.
     */
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->post('/api/login', [ // ✅ Oprava routy: /api/login
            'email' => $user->email,
            'password' => 'password',
        ])->assertStatus(200); // ✅ Pri API s dátami očakávame 200 OK

        // Overenie, že používateľ je prihlásený v teste (len pre session testy, ale ponechávame pre kompatibilitu)
        // Pri API tokenoch sa obvykle kontroluje len token.
        // $this->assertAuthenticated();

        // ✅ Overenie, že bola vrátená JSON štruktúra s access_token a používateľskými dátami
        $response->assertJsonStructure([
            'access_token',
            'user' => [
                'id',
                'name',
                'email',
            ]
        ]);
    }

    /**
     * Testuje neúspešné prihlásenie s nesprávnym heslom.
     */
    public function test_users_can_not_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create();

        $this->post('/api/login', [ // ✅ Oprava routy: /api/login
            'email' => $user->email,
            'password' => 'wrong-password',
        ])->assertStatus(401); // ✅ Pri neúspešnom prihlásení v API očakávame 401 Unauthorized

        $this->assertGuest();
    }

    /**
     * Testuje odhlásenie.
     */
    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        // ✅ Oprava routy: /api/logout
        // Používame `actingAs` na simuláciu prihlásenia (čo funguje so session)
        // a voláme API routu.
        $response = $this->actingAs($user)->post('/api/logout');

        $this->assertGuest();

        // ✅ Odhlásenie v API zvyčajne vracia 204 No Content, keďže invaliduje token (a nevracia dáta)
        $response->assertNoContent();
    }
}
