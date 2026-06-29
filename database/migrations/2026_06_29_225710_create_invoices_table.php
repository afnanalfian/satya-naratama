<?php
// database/migrations/2026_01_15_000004_create_invoices_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke pendaftaran
            $table->foreignId('registration_id')->constrained('student_registrations')->onDelete('cascade');
            
            // Nomor Invoice (format: INV/YYYYMMDD/XXXXX)
            $table->string('invoice_number', 50)->unique();
            
            // Detail Invoice
            $table->decimal('amount', 15, 2);
            $table->string('description', 255)->nullable();
            
            // Status Invoice
            $table->enum('status', [
                'pending',      // Belum dibayar
                'paid',         // Sudah dibayar
                'verified',     // Diverifikasi admin
                'cancelled'     // Dibatalkan
            ])->default('pending');
            
            // Data Pembayaran
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_proof', 191)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            
            // Data Verifikasi Admin
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->text('verification_notes')->nullable();
            
            // Metadata
            $table->json('metadata')->nullable();
            
            $table->timestamps();
            
            // Indexes
            $table->index('invoice_number');
            $table->index('status');
            $table->index('registration_id');
            $table->index('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};