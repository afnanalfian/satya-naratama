<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductBonusesTable extends Migration
{
    public function up()
    {
        Schema::create('product_bonuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->enum('bonus_type', ['meeting','course','tryout','quiz']);
            $table->unsignedBigInteger('bonus_id')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_bonuses');
    }
}
