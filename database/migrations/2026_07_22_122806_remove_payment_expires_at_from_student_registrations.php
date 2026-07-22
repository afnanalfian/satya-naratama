<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('student_registrations', function (Blueprint $table) {
            $table->dropColumn('payment_expires_at');
        });
    }

    public function down()
    {
        Schema::table('student_registrations', function (Blueprint $table) {
            $table->timestamp('payment_expires_at')->nullable()->after('payment_verified_at');
        });
    }
};
