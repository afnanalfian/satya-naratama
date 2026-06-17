<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingRulesTable extends Migration
{
    public function up()
    {
        Schema::create('pricing_rules', function (Blueprint $table) {
            $table->id();
            $table->enum('product_type', ['meeting','tryout','course_package','addon']);
            $table->unsignedInteger('min_qty')->default(1);
            $table->unsignedInteger('max_qty')->nullable();
            $table->decimal('price_per_unit', 12, 2)->nullable();
            $table->decimal('fixed_price', 12, 2)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('productables');
    }
}
