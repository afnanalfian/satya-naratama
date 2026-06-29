<?php
// database/migrations/2026_01_15_000002_create_kelurahans_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('kelurahans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan_id')->constrained('kecamatans')->onDelete('cascade');
            $table->string('code', 20)->unique();
            $table->string('name', 191);
            $table->timestamps();
            
            $table->index('kecamatan_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kelurahans');
    }
};