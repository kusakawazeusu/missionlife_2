<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Quest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quest', function (Blueprint $table) {
        $table->increments('id')->unique();
        $table->string('name');
        $table->string('creator');
        $table->date('start_at');
        $table->date('end_at');
        $table->string('description');
        $table->integer('salary');
        $table->integer('point');
        $table->boolean('activation');
        $table->integer('workforce');
        $table->integer('catalog');
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
        Schema::drop('quest');
    }
}
