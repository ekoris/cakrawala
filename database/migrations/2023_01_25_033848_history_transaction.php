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
        Schema::create('history_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_id')->nullable();
            $table->string('transaction_table')->nullable();
            $table->integer('account_id')->nullable();
            $table->integer('total')->nullable();
            $table->integer('status')->nullable();
            $table->integer('type')->nullable();
            $table->timestamps();
        });

        Schema::create('history_transaction_approvals', function (Blueprint $table) {
            $table->id();
            $table->integer('history_transaction_id')->nullable();
            $table->integer('approval_by')->nullable();
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
