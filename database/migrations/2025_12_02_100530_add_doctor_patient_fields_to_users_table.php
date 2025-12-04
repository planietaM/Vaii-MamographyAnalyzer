<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Pridáva stĺpce pre Doktorov a Pacientov.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // ROLE a ZÁKLADNÉ ÚDAJE (Predpokladáme, že sa pridávajú po 'password')
            $table->enum('role', ['patient', 'doctor', 'admin'])->default('patient')->after('password');
            $table->string('surname')->nullable()->after('name');
            $table->string('phone')->nullable()->after('email');

            // ÚDAJE PRE DOKTORA (Nullable, lebo Pacienti ich nebudú mať)
            $table->string('dikter_id')->nullable()->unique()->after('phone');
            $table->string('specialization')->nullable()->after('dikter_id');
            $table->string('workplace')->nullable()->after('specialization');

            // ÚDAJE PRE PACIENTA (Nullable, lebo Doktori ich nebudú mať)
            $table->string('national_id')->nullable()->unique()->after('workplace'); // Rodné číslo
            $table->date('birth_date')->nullable()->after('national_id');
            $table->enum('gender', ['male', 'female'])->nullable()->after('birth_date');
        });
    }

    /**
     * Vracia zmeny.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'role', 'surname', 'phone',
                'dikter_id', 'specialization', 'workplace',
                'national_id', 'birth_date', 'gender'
            ]);
        });
    }
};
