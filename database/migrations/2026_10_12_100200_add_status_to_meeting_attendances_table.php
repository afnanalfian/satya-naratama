<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Absensi berbasis scan QR.
 * - status : hadir | izin | sakit | alpa
 * - method : scan (QR) | manual (input admin)
 * - marked_at (kolom lama) dipakai sebagai timestamp kehadiran
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meeting_attendances', function (Blueprint $table) {
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpa'])
                ->default('alpa')
                ->after('is_present');
            $table->enum('method', ['scan', 'manual'])
                ->default('manual')
                ->after('status');
            $table->string('note', 255)->nullable()->after('method');
            $table->index(['user_id', 'status']);
        });

        // Data lama: is_present = true -> hadir
        DB::table('meeting_attendances')->where('is_present', true)->update(['status' => 'hadir']);
        DB::table('meeting_attendances')->where('is_present', false)->update(['status' => 'alpa']);
    }

    public function down(): void
    {
        Schema::table('meeting_attendances', function (Blueprint $table) {
            $table->dropIndex(['user_id', 'status']);
            $table->dropColumn(['status', 'method', 'note']);
        });
    }
};
