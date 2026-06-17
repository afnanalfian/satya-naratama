<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('question_sub_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_item_id')->constrained('question_sub_items')->cascadeOnDelete();
            $table->enum('type', ['truefalse','short_answer']);
            $table->boolean('boolean_answer')->nullable();// Untuk BENAR / SALAH
            $table->string('answer_text')->nullable();// Untuk ISIAN SINGKAT
            $table->boolean('is_primary')->default(false);// Jawaban utama (untuk pembahasan)
            $table->timestamps();
            $table->index(['sub_item_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_sub_answers');
    }
};
