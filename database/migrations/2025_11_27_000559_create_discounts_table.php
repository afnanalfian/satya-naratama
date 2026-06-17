<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountsTable extends Migration
{
    public function up()
    {
        Schema::create('discounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable()->unique(); // untuk voucher
            $table->enum('type', ['percentage','fixed']);
            $table->decimal('value', 12, 2); // % atau nominal
            $table->decimal('max_discount', 12, 2)->nullable();
            $table->decimal('min_order_amount', 12, 2)->nullable();
            $table->unsignedInteger('quota')->nullable();
            $table->unsignedInteger('used')->default(0);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discounts');
    }
}
