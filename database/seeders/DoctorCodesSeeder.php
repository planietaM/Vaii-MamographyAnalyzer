<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DoctorCodesSeeder extends Seeder
{
    public function run(): void
    {
        $codes = [
            '000000','111111','222222','333333','444444',
            '555555','666666','777777','888888','999999'
        ];

        foreach ($codes as $code) {
            // insert only if not exists
            $exists = DB::table('doctor_codes')->where('code', $code)->exists();
            if (! $exists) {
                DB::table('doctor_codes')->insert(['code' => $code, 'created_at' => now(), 'updated_at' => now()]);
            }
        }
    }
}

