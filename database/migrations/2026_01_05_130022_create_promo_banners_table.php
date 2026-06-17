<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promo_banners', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('image_path'); // Path gambar poster
            $table->string('target_url')->nullable(); // Link ketika diklik
            $table->boolean('is_active')->default(true);
            $table->boolean('show_on_landing')->default(true);
            $table->enum('type', ['popup', 'banner', 'modal'])->default('popup');
            $table->integer('display_delay')->default(3000); // Delay dalam ms
            $table->integer('display_duration')->default(30); // Durasi dalam detik
            $table->integer('priority')->default(1);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promo_banners');
    }
};
