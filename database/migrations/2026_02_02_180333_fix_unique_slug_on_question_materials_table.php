<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('question_materials', function (Blueprint $table) {

            // 1. Drop unique index lama (slug)
            $table->dropUnique(['slug']);

            // 2. Tambahkan composite unique (category_id + slug)
            $table->unique(['category_id', 'slug'], 'qm_category_slug_unique');
        });
    }

    public function down(): void
    {
        Schema::table('question_materials', function (Blueprint $table) {

            // rollback: hapus composite unique
            $table->dropUnique('qm_category_slug_unique');

            // kembalikan unique slug global
            $table->unique('slug');
        });
    }
};
