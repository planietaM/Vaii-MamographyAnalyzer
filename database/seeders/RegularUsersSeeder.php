<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RegularUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Anna',
                'surname' => 'Kovacova',
                'email' => 'user1@example.com',
                'password' => 'password',
                'phone' => '+421905111111',
                'national_id' => '780101/0001',
                'birth_date' => '1978-01-01',
            ],
            [
                'name' => 'Martin',
                'surname' => 'Bartos',
                'email' => 'user2@example.com',
                'password' => 'password',
                'phone' => '+421905222222',
                'national_id' => '850505/0002',
                'birth_date' => '1985-05-05',
            ],
            [
                'name' => 'Petra',
                'surname' => 'Marekova',
                'email' => 'user3@example.com',
                'password' => 'password',
                'phone' => '+421905333333',
                'national_id' => '900303/0003',
                'birth_date' => '1990-03-03',
            ],
            [
                'name' => 'Juraj',
                'surname' => 'Novotny',
                'email' => 'user4@example.com',
                'password' => 'password',
                'phone' => '+421905444444',
                'national_id' => '920707/0004',
                'birth_date' => '1992-07-07',
            ],
            [
                'name' => 'Lucia',
                'surname' => 'Svoboda',
                'email' => 'user5@example.com',
                'password' => 'password',
                'phone' => '+421905555555',
                'national_id' => '940909/0005',
                'birth_date' => '1994-09-09',
            ],
        ];

        foreach ($users as $data) {
            $attributes = [
                'name' => $data['name'],
                'surname' => $data['surname'] ?? null,
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'patient',
                'phone' => $data['phone'] ?? null,
                'national_id' => $data['national_id'] ?? null,
                'birth_date' => $data['birth_date'] ?? null,
            ];

            $user = User::updateOrCreate(
                ['email' => $data['email']],
                $attributes
            );

            if ($user->wasRecentlyCreated) {
                $this->command->info("Patient created: {$data['email']}");
            } else {
                $this->command->info("Patient updated or existed: {$data['email']}");
            }
        }
    }
}
