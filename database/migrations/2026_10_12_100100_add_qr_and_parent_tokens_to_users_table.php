<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

/**
 * - qr_token     : isi QR code kartu siswa (untuk scan absensi)
 * - parent_token : token rahasia untuk link pantauan orang tua (tanpa login)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('qr_token', 64)->nullable()->unique()->after('is_active');
            $table->string('parent_token', 64)->nullable()->unique()->after('qr_token');
        });

        // Backfill semua user yang sudah ada
        DB::table('users')->select('id')->orderBy('id')->chunkById(500, function ($users) {
            foreach ($users as $user) {
                DB::table('users')->where('id', $user->id)->update([
                    'qr_token'     => Str::upper(Str::random(24)),
                    'parent_token' => Str::random(40),
                ]);
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropUnique(['qr_token']);
            $table->dropUnique(['parent_token']);
            $table->dropColumn(['qr_token', 'parent_token']);
        });
    }
};
