<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountablesTable extends Migration
{
    public function up()
    {
        Schema::create('discountables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('discount_id')->constrained()->cascadeOnDelete();
            $table->morphs('discountable');
        });
    }

    public function down()
    {
        Schema::dropIfExists('discountables');
    }
}
