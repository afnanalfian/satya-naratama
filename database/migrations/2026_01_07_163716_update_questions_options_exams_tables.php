<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Tambah kolom test_type di questions
        Schema::table('questions', function (Blueprint $table) {
            $table->enum('test_type', ['general','tiu', 'twk', 'tkp', 'mtk_stis', 'mtk_tka'])
                  ->after('type');
        });

        // Tambah kolom weight di question_options
        Schema::table('question_options', function (Blueprint $table) {
            $table->integer('weight')->default(0)->after('order');
        });

        // Tambah kolom test_type di exams
        Schema::table('exams', function (Blueprint $table) {
            $table->enum('test_type', ['skd', 'mtk_stis', 'mtk_tka'])
                  ->after('type');
        });
    }

    public function down(): void
    {
        // Hapus kolom test_type di questions
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('test_type');
        });

        // Hapus kolom weight di question_options
        Schema::table('question_options', function (Blueprint $table) {
            $table->dropColumn('weight');
        });

        // Hapus kolom test_type di exams
        Schema::table('exams', function (Blueprint $table) {
            $table->dropColumn('test_type');
        });
    }
};
