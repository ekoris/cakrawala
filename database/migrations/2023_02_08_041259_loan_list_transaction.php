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
        Schema::create('loan_list_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('loan_list_financing_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('total')->nullable();
            $table->integer('approver_id')->nullable();
            $table->integer('status')->nullable();
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
        //
    }
};
