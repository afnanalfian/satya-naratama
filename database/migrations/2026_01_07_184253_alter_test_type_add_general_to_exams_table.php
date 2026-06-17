<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->enum('test_type', ['skd', 'mtk_stis', 'mtk_tka', 'general'])
                  ->nullable()
                  ->after('type')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('exams', function (Blueprint $table) {
            $table->enum('test_type', ['skd', 'mtk_stis', 'mtk_tka'])
                  ->nullable()
                  ->after('type')
                  ->change();
        });
    }
};
