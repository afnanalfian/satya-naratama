<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Ubah kolom answer_text menjadi text (lebih fleksibel)
        Schema::table('question_sub_answers', function (Blueprint $table) {
            $table->text('answer_text')->nullable()->change();
        });

        // Tambah kolom normalized_text untuk pencocokan case-insensitive
        Schema::table('question_sub_answers', function (Blueprint $table) {
            $table->text('normalized_text')->nullable()->after('answer_text');
            $table->index(['sub_item_id', 'type'], 'sub_item_type_index');
        });
    }

    public function down(): void
    {
        Schema::table('question_sub_answers', function (Blueprint $table) {
            $table->string('answer_text', 255)->nullable()->change();
            $table->dropColumn('normalized_text');
            $table->dropIndex('sub_item_type_index');
        });
    }
};
