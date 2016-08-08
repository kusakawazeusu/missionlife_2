<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('um', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('quest_id');
            $table->integer('status');
            $table->timestamps('create_at');
            $table->dateTime('finish_at');
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
        Schema::drop('um');
    }
}
