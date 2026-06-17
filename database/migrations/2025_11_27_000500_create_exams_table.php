<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['post_test','quiz','tryout',]);
            $table->string('title')->nullable();
            $table->dateTime('exam_date')->nullable();
            $table->unsignedInteger('duration_minutes')->nullable();
            $table->enum('status', ['inactive','active','closed',])->default('inactive');
            $table->nullableMorphs('owner');
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
