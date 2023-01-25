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
        Schema::create('saving_deposits', function (Blueprint $table) {
            $table->id();
            $table->integer('account_id')->nullable();
            $table->integer('type')->nullable();
            $table->string('total_balance')->nullable();
            $table->dateTime('last_updated_at')->nullable();
            $table->integer('last_update_by')->nullable();
            $table->timestamps();
        });

        Schema::create('saving_deposit_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('saving_deposit_id')->nullable();
            $table->integer('total')->nullable();
            $table->dateTime('date_transaction')->nullable();
            $table->integer('status')->nullable();
            $table->integer('confirm_by')->nullable();
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
