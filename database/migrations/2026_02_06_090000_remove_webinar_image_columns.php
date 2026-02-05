<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('webinars', function (Blueprint $table) {
            if (Schema::hasColumn('webinars', 'image_data')) {
                $table->dropColumn('image_data');
            }
            if (Schema::hasColumn('webinars', 'image')) {
                $table->dropColumn('image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('webinars', function (Blueprint $table) {
            if (!Schema::hasColumn('webinars', 'image')) {
                $table->string('image')->nullable()->after('telephone');
            }
            if (!Schema::hasColumn('webinars', 'image_data')) {
                $table->text('image_data')->nullable()->after('image');
            }
        });
    }
};

