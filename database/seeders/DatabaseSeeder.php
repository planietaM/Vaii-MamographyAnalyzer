<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            \Database\Seeders\DoctorCodesSeeder::class,
            AdminUserSeeder::class,
            \Database\Seeders\DoctorUsersSeeder::class,
            \Database\Seeders\RegularUsersSeeder::class,
            // ... prípadne ďalšie seedery
        ]);

        // Optional test user (kept for compatibility)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
