<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->unsignedBigInteger('province_id')
                ->nullable()
                ->after('name');

            $table->unsignedBigInteger('regency_id')
                ->nullable()
                ->after('province_id');

            $table->string('phone')
                ->nullable()
                ->after('regency_id');

            $table->string('avatar')
                ->nullable()
                ->after('phone');

            $table->boolean('is_active')
                ->default(true)
                ->after('avatar');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'province_id',
                'regency_id',
                'phone',
                'avatar',
                'is_active'
            ]);
        });
    }
}
