<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Použijeme env premenné, ak sú dostupné, inak použijeme predvolené hodnoty
        $adminEmail = env('SEED_ADMIN_EMAIL', 'admin@mamography.sk');
        $adminName = env('SEED_ADMIN_NAME', 'Admin');
        $adminPassword = env('SEED_ADMIN_PASSWORD', 'password');

        // Použijeme updateOrCreate, aby bol seeder idempotentný
        $admin = User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => $adminName,
                'email' => $adminEmail,
                'password' => Hash::make($adminPassword),
                'role' => 'admin',
            ]
        );

        if ($admin->wasRecentlyCreated) {
            $this->command->info("Admin vytvoren: {$adminEmail}");
        } else {
            $this->command->info("Admin aktualizovaný (alebo už existoval): {$adminEmail}");
        }
    }
}
