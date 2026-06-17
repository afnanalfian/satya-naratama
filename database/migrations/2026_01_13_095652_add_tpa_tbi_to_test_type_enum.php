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
