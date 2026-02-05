<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            if (!Schema::hasColumn('testimonials', 'image_data')) {
                $table->text('image_data')->nullable()->after('image');
            }
        });

        Schema::table('webinars', function (Blueprint $table) {
            if (!Schema::hasColumn('webinars', 'image_data')) {
                $table->text('image_data')->nullable()->after('image');
            }
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            if (Schema::hasColumn('testimonials', 'image_data')) {
                $table->dropColumn('image_data');
            }
        });

        Schema::table('webinars', function (Blueprint $table) {
            if (Schema::hasColumn('webinars', 'image_data')) {
                $table->dropColumn('image_data');
            }
        });
    }
};

