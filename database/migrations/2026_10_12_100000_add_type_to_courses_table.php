<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Jenis course:
 * - akademik : pertemuan berisi absensi, materi, video, blind/post test
 * - jasmani  : pertemuan hanya berisi absensi dan materi
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->enum('type', ['akademik', 'jasmani'])
                ->default('akademik')
                ->after('slug')
                ->index();
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropColumn('type');
        });
    }
};
