<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminWalletSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_wallet_settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('coin_currency_value')->nullable();
            $table->string('currency')->nullable();
            $table->integer('free_signup_coin')->nullable();
            $table->integer('bonus_coin')->nullable();
            $table->integer('first_time_chat_coin_cost')->nullable();
            $table->integer('referrer_percent')->nullable();
            $table->integer('admin_commision_percent')->nullable();
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
        Schema::dropIfExists('admin_wallet_settings');
    }
}
