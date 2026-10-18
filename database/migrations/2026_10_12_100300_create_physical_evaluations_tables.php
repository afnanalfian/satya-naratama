<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Evaluasi jasmani bulanan.
 * Kolom hasil mengikuti format lama:
 * LARI 12 menit (meter) | PULL UP (putra) / CHINNING (putri) | PUSH UP | SIT UP | SHUTTLE RUN (detik)
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('physical_evaluations', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('period');          // selalu tanggal 1 (bulan evaluasi)
            $table->date('held_on');         // tanggal pelaksanaan
            $table->string('location')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('period');
        });

        Schema::create('physical_evaluation_results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('physical_evaluation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->char('gender', 1)->nullable();                     // snapshot L / P
            $table->unsignedSmallInteger('run_12min_m')->nullable();   // meter
            $table->unsignedSmallInteger('pull_up_chinning')->nullable(); // L: pull up, P: chinning
            $table->unsignedSmallInteger('push_up')->nullable();
            $table->unsignedSmallInteger('sit_up')->nullable();
            $table->decimal('shuttle_run_sec', 5, 2)->nullable();      // detik
            $table->string('notes', 255)->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['physical_evaluation_id', 'user_id'], 'phys_eval_user_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('physical_evaluation_results');
        Schema::dropIfExists('physical_evaluations');
    }
};
