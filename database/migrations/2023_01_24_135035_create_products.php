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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->integer('price')->nullable();
            $table->timestamps();
        });

        Schema::create('product_photos', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->string('attachment')->nullable();
            $table->integer('is_thumbnail')->default(0)->nullable();
            $table->timestamps();
        });
        
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
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
        Schema::dropIfExists('products');
    }
};
