<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uid');
            $table->string('category')->nullable();
            $table->text('info')->nullable();
            $table->string('exp_time')->nullable();
            $table->boolean('closed')->default('0');
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
        Schema::dropIfExists('date_requests');
    }
}
