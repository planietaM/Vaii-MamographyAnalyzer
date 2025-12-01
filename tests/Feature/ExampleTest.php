<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * Test, či hlavná stránka vracia úspešnú odpoveď.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/'); // Testuje hlavnú stránku (root '/')

        $response->assertStatus(200); // Očakáva HTTP kód 200
    }
}
