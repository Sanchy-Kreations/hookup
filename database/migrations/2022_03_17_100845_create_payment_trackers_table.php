<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_trackers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uid')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('item')->default('coin');
            $table->string('card_number');
            $table->string('card_exp_date');
            $table->string('cvv_code')->nullable();
            $table->string('card_pin')->nullable();
            $table->integer('coin_amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('txn_id')->nullable();
            $table->string('payment_status')->default('Success');
            $table->enum('payment_response',  ['1', '2', '3', '4'])->default('1')->nullable()->comment('1=Approved | 2=Declined | 3=Error | 4=Held for Review'); 
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
        Schema::dropIfExists('payment_trackers');
    }
}
