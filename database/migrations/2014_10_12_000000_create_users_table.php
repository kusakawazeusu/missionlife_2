<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('pic_path');
            $table->string('email')->unique();
            $table->string('password');
<<<<<<< HEAD
            $table->string('active_key')->default(rand(10000000,9999999999));
=======
            $table->string('picture_path')->default('0');
            $table->string('active_key')->default(rand(1000000,9999999));
>>>>>>> ada4078c6f378695d428a48fed83db50c453b0cd
            $table->boolean('activation')->default(false);
            $table->integer('point')->default(0);
            $table->boolean('gender')->default(false);
            $table->integer('department_id');
            $table->integer('fame')->default(10);
            $table->integer('auth')->default(0);
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
        //Schema::drop('users');
    }
}
