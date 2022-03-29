<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('username')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('age')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('country_code')->nullable();
            $table->longtext('img_1')->nullable();
            $table->longtext('images')->nullable();
            $table->boolean('verified')->default('0');
            $table->longtext('verified_img')->nullable();
            $table->string('gender')->nullable();
            $table->string('gender_interest')->nullable();
            $table->integer('referrer_id')->nullable();
            $table->boolean('role')->default('3');
            $table->string('user_type')->default('escort');
            $table->boolean('private')->default('0');
            $table->boolean('subscribed')->default('0');
            $table->string('status')->default('Inactive');
            $table->boolean('loggedIn')->default('0');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
