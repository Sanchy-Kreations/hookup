<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('uid');
            $table->longtext('about')->nullable();
            $table->string('drinking')->nullable();
            $table->string('smoking')->nullable();
            $table->string('sexual_orientation')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('body_type')->nullable();
            $table->string('ethnicity')->nullable();
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
        Schema::dropIfExists('user_data');
    }
}
