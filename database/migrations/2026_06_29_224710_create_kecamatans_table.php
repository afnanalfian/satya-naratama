<?php
// database/migrations/2026_01_15_000001_create_kecamatans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kecamatans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('regency_id')->constrained('regencies')->onDelete('cascade');
            $table->string('code', 20)->unique();
            $table->string('name', 191);
            $table->timestamps();
            
            $table->index('regency_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kecamatans');
    }
};