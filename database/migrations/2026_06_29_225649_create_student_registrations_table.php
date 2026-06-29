<?php
// database/migrations/2026_01_15_000003_create_student_registrations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('student_registrations', function (Blueprint $table) {
            $table->id();
            
            // Data Pribadi
            $table->string('full_name', 191);
            $table->string('nickname', 100)->nullable();
            $table->date('birth_date');
            $table->enum('gender', ['L', 'P']);
            $table->string('school_origin', 255);
            $table->enum('class', ['X', 'XI', 'XII', 'Alumni']);
            $table->string('phone', 20);
            
            // Data Wilayah (Pangkep)
            $table->foreignId('kecamatan_id')->constrained('kecamatans')->onDelete('restrict');
            $table->foreignId('kelurahan_id')->constrained('kelurahans')->onDelete('restrict');
            
            // Data Fisik
            $table->unsignedSmallInteger('height_cm')->nullable();
            $table->unsignedSmallInteger('weight_kg')->nullable();
            
            // Kampus Impian
            $table->enum('priority_university_1', [
                'STIS', 'STAN', 'IPDN', 'STMKG', 'SSN', 
                'STIN', 'STTD', 'POLTEKIMIPAS', 'AKPOL', 'AKMIL', 'UNHAN'
            ]);
            $table->enum('priority_university_2', [
                'STIS', 'STAN', 'IPDN', 'STMKG', 'SSN', 
                'STIN', 'STTD', 'POLTEKIMIPAS', 'AKPOL', 'AKMIL', 'UNHAN'
            ])->nullable();
            
            // Data Orangtua
            $table->string('parent_name', 191);
            $table->string('parent_occupation', 255)->nullable();
            $table->string('parent_phone', 20);
            
            // Data Akun (untuk dibuat nanti setelah verifikasi)
            $table->string('email', 191)->unique();
            $table->string('password', 191);
            
            // Upload
            $table->string('avatar', 191)->nullable();
            
            // Data Pembayaran
            $table->decimal('registration_fee', 15, 2)->default(6000000.00);
            $table->enum('payment_status', [
                'pending',      // Belum bayar
                'paid',         // Sudah upload bukti, menunggu verifikasi
                'verified',     // Pembayaran diverifikasi admin
                'rejected',     // Pembayaran ditolak
                'expired'       // Melewati batas waktu pembayaran
            ])->default('pending');
            $table->string('payment_proof', 191)->nullable();
            $table->timestamp('payment_verified_at')->nullable();
            $table->timestamp('payment_expires_at')->nullable();
            
            // Data Verifikasi Admin
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('verification_notes')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->text('rejection_reason')->nullable();
            
            // Meta Data
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            
            // User ID setelah akun dibuat
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            // Status Pendaftaran
            $table->enum('registration_status', [
                'draft',                    // Belum selesai mengisi
                'pending_payment',          // Menunggu pembayaran
                'awaiting_verification',    // Sudah bayar, menunggu verifikasi admin
                'verified',                 // Diverifikasi, akun dibuat
                'rejected'                  // Ditolak
            ])->default('draft');
            
            $table->timestamps();
            
            // Indexes untuk performa
            $table->index('email');
            $table->index('payment_status');
            $table->index('registration_status');
            $table->index('created_at');
            $table->index('kecamatan_id');
            $table->index('kelurahan_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_registrations');
    }
};