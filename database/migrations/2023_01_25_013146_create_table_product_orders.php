<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('total_order')->nullable();
            $table->integer('payment_id')->nullable();
            $table->integer('status')->nullable();
            $table->integer('payment_type')->nullable();
            $table->integer('validate_by')->nullable();
            $table->dateTime('finish_order_date')->nullable();
            $table->timestamps();
        });

        Schema::create('payment_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('order_product_id')->nullable();
            $table->integer('type')->nullable();
            $table->string('attachment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_product_orders');
    }
};
