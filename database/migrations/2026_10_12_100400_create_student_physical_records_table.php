<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Data fisik bulanan siswa: tinggi, berat, penyakit & cedera pada bulan tsb.
 * Diisi siswa, bisa dikoreksi admin.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_physical_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->date('period');                       // selalu tanggal 1
            $table->decimal('height_cm', 5, 1);
            $table->decimal('weight_kg', 5, 1);
            $table->boolean('has_illness')->default(false);
            $table->text('illness_notes')->nullable();
            $table->boolean('has_injury')->default(false);
            $table->text('injury_notes')->nullable();
            $table->text('notes')->nullable();
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'period']);
            $table->index('period');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_physical_records');
    }
};
