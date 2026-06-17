<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('exam_prerequisites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->cascadeOnDelete();
            $table->foreignId('required_exam_id')->constrained('exams')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['exam_id', 'required_exam_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_prerequisites');
    }
};
