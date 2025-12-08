<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctor_codes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 6)->unique();
            $table->timestamps();
        });

        // Insert initial allowed codes
        $codes = [
            '000000','111111','222222','333333','444444',
            '555555','666666','777777','888888','999999'
        ];

        $now = now();
        $rows = array_map(function ($c) use ($now) {
            return ['code' => $c, 'created_at' => $now, 'updated_at' => $now];
        }, $codes);

        DB::table('doctor_codes')->insert($rows);
    }

    public function down(): void
    {
        Schema::dropIfExists('doctor_codes');
    }
};

