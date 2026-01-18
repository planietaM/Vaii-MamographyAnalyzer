<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\DoctorCode;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'MUDr. Jana',
                'surname' => 'Novakova',
                'email' => 'jana.novakova@mammo.sk',
                'password' => 'password',
                'specialization' => 'Radiology',
                'workplace' => 'Nemocnica A',
                'phone' => '+421900111111',
            ],
            [
                'name' => 'MUDr. Peter',
                'surname' => 'Svoboda',
                'email' => 'peter.svoboda@mammo.sk',
                'password' => 'password',
                'specialization' => 'Oncology',
                'workplace' => 'Klinika B',
                'phone' => '+421900222222',
            ],
            [
                'name' => 'MUDr. Lucia',
                'surname' => 'Horvathova',
                'email' => 'lucia.horvathova@mammo.sk',
                'password' => 'password',
                'specialization' => 'Mammography',
                'workplace' => 'Súkromná Prac.',
                'phone' => '+421900333333',
            ],
        ];

        // Get available doctor codes (those not currently assigned to a user)
        $usedCodes = User::whereNotNull('dikter_id')->pluck('dikter_id')->filter()->all();
        $availableCodes = DoctorCode::whereNotIn('code', $usedCodes)->pluck('code')->all();

        foreach ($doctors as $index => $data) {
            $code = $availableCodes[$index] ?? null;

            $attributes = [
                'name' => $data['name'],
                'surname' => $data['surname'] ?? null,
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 'doctor',
                'specialization' => $data['specialization'] ?? null,
                'workplace' => $data['workplace'] ?? null,
                'phone' => $data['phone'] ?? null,
            ];

            if ($code) {
                $attributes['dikter_id'] = $code;
            }

            User::updateOrCreate(
                ['email' => $data['email']],
                $attributes
            );

            $this->command->info("Doctor seeded/updated: {$data['email']}" . ($code ? " (code: $code)" : ""));
        }
    }
}

