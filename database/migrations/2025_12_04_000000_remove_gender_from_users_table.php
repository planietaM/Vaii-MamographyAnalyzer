<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Remove the `gender` column from users.
     */
    public function up(): void
    {
        if (Schema::hasColumn('users', 'gender')) {
            Schema::table('users', function (Blueprint $table) {
                // If it's an enum or string, dropColumn will remove it.
                $table->dropColumn('gender');
            });
        }
    }

    /**
     * Restore the `gender` column (if you need to roll back).
     */
    public function down(): void
    {
        if (! Schema::hasColumn('users', 'gender')) {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('gender', ['male', 'female'])->nullable()->after('birth_date');
            });
        }
    }
};

