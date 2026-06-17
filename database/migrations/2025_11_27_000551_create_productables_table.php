<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductablesTable extends Migration
{
    public function up()
    {
        Schema::create('productables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->morphs('productable');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productables');
    }
}
