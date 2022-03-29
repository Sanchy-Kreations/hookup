<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sender_id');
            $table->integer('recipient_id');
            $table->integer('amount');
            $table->enum('response', ['Accepted', 'Declined'])->nullable();
            $table->boolean('paid')->default('0');
            $table->enum('sender_confirmed', ['Accepted', 'Declined'])->nullable();
            $table->boolean('recipient_confirmed')->default('0');
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
        Schema::dropIfExists('offers');
    }
}
