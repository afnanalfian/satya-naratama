<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('exam_attempts', function (Blueprint $table) {
            $table->unsignedInteger('correct_count')
                ->default(0)
                ->after('score');

            $table->unsignedInteger('wrong_count')
                ->default(0)
                ->after('correct_count');
        });
    }

    public function down(): void
    {
        Schema::table('exam_attempts', function (Blueprint $table) {
            $table->dropColumn([
                'correct_count',
                'wrong_count',
            ]);
        });
    }
};
