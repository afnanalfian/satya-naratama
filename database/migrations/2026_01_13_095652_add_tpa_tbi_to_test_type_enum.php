<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // SQLite (pengujian lokal) tidak mengenal MODIFY ENUM. Produksi MySQL tidak terpengaruh.
        if (DB::getDriverName() === 'sqlite') { Schema::table('questions', fn (Blueprint $t) => $t->string('test_type')->change()); Schema::table('exams', fn (Blueprint $t) => $t->string('test_type')->nullable()->change()); return; }

        // questions.test_type
        DB::statement("
            ALTER TABLE questions
            MODIFY COLUMN test_type ENUM(
                'general',
                'tiu',
                'twk',
                'tkp',
                'mtk_stis',
                'mtk_tka',
                'tpa',
                'tbi'
            ) NOT NULL
        ");

        // exams.test_type
        DB::statement("
            ALTER TABLE exams
            MODIFY COLUMN test_type ENUM(
                'skd',
                'mtk_stis',
                'mtk_tka',
                'general',
                'tpa',
                'tbi'
            ) NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') { return; }

        DB::statement("
            ALTER TABLE questions
            MODIFY COLUMN test_type ENUM(
                'general',
                'tiu',
                'twk',
                'tkp',
                'mtk_stis',
                'mtk_tka'
            ) NOT NULL
        ");

        DB::statement("
            ALTER TABLE exams
            MODIFY COLUMN test_type ENUM(
                'skd',
                'mtk_stis',
                'mtk_tka',
                'general'
            ) NULL
        ");
    }
};
