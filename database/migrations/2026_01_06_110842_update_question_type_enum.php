<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // SQLite (pengujian lokal) tidak mengenal MODIFY ENUM. Produksi MySQL tidak terpengaruh.
        if (DB::getDriverName() === 'sqlite') { Schema::table('questions', fn (Blueprint $t) => $t->string('type')->change()); return; }

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
        if (DB::getDriverName() === 'sqlite') { return; }

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
