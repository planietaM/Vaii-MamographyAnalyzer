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
        // Ensure there's a sane admin account. Use updateOrCreate so running seeder multiple times is safe.
        $admin = User::updateOrCreate(
            ['email' => 'admin@mammo.sk'],
            [
                'name' => 'Admin',
                'surname' => 'Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '+421900000001',
            ]
        );

        $this->command->info('Admin user ensured: ' . $admin->email);
    }
}
