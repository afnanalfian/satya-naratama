<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDiscountsTable extends Migration
{
    public function up()
    {
        Schema::create('user_discounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('discount_id')->constrained()->cascadeOnDelete();
            $table->timestamp('used_at')->nullable();
            $table->unique(['user_id','discount_id']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_discounts');
    }
}
