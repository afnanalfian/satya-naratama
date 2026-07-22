<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('student_registrations', function (Blueprint $table) {
            $table->enum('shirt_size', ['S', 'M', 'L', 'XL', 'XXL'])->nullable()->after('weight_kg');
        });
    }

    public function down()
    {
        Schema::table('student_registrations', function (Blueprint $table) {
            $table->dropColumn('shirt_size');
        });
    }
};
