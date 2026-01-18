<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FakeUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Create 3 doctors
        for ($i = 1; $i <= 3; $i++) {
            User::updateOrCreate(
                ['email' => "doctor{$i}@mammo.sk"],
                [
                    'name' => "Doktor $i",
                    'surname' => 'Lekár',
                    'email' => "doctor{$i}@mammo.sk",
                    'password' => Hash::make('password'),
                    'role' => 'doctor',
                    'phone' => "+42190000000{$i}",
                    'specialization' => 'Radiology',
                    'workplace' => "Nemocnica $i",
                ]
            );
        }

        // Create 5 patients with full fields
        for ($i = 1; $i <= 5; $i++) {
            User::updateOrCreate(
                ['email' => "user{$i}@example.com"],
                [
                    'name' => "Pacient $i",
                    'surname' => "Priezvisko $i",
                    'email' => "user{$i}@example.com",
                    'password' => Hash::make('password'),
                    'role' => 'patient',
                    'phone' => "+4219100000{$i}",
                    'national_id' => 'ID' . str_pad((string)$i, 6, '0', STR_PAD_LEFT),
                    'birth_date' => now()->subYears(30 + $i)->toDateString(),
                ]
            );
        }

        $this->command->info('Created 3 doctors and 5 patients (or ensured they exist).');
    }
}

