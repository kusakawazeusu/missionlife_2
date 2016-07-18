<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Dialog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dialog', function (Blueprint $table) {
            $table->integer('ordered')->default(0);
            $table->increments('id')->unique();
            $table->string('ocassion');
            $table->string('pic_path');
            $table->string('name');
            $table->string('context');
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
}
