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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->nullable();
            $table->integer('type')->nullable();
            $table->integer('total_loan')->nullable();
            $table->integer('tenors')->nullable();
            $table->integer('tenor_type')->nullable();
            $table->integer('collateral_id')->nullable();
            $table->timestamps();
        });

        Schema::create('loan_list_financings', function (Blueprint $table) {
            $table->id();
            $table->integer('loan_id')->nullable();
            $table->integer('total_installment')->nullable();
            $table->date('due_date')->nullable();
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
