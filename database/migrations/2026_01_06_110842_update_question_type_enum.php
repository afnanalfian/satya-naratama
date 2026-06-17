<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE questions
            MODIFY COLUMN type ENUM(
                'mcq',
                'mcma',
                'truefalse',
                'short_answer',
                'compound'
            ) NOT NULL
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE questions
            MODIFY COLUMN type ENUM(
                'mcq',
                'mcma',
                'truefalse'
            ) NOT NULL
        ");
    }
};
