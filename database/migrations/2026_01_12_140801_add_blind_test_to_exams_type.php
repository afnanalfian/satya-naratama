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
        if (DB::getDriverName() === 'sqlite') { Schema::table('exams', fn (Blueprint $t) => $t->string('type')->change()); return; }

        DB::statement("
            ALTER TABLE exams
            MODIFY COLUMN type
            ENUM(
                'post_test',
                'quiz',
                'tryout',
                'blind_test'
            ) NOT NULL
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (DB::getDriverName() === 'sqlite') { return; }

        DB::statement("
            ALTER TABLE exams
            MODIFY COLUMN type
            ENUM(
                'post_test',
                'quiz',
                'tryout'
            ) NOT NULL
        ");
    }
};
