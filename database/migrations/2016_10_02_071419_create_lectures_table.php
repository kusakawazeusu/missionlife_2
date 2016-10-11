<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('creator');
            $table->string('speaker');
            $table->date('apply_start_at'); //報名時間
            $table->date('apply_end_at');
            $table->date('execute_start_at'); //執行時間
            $table->date('execute_end_at');
            $table->string('place');//講座地點
            $table->string('description'); //講座描述
            $table->string('admission_fee');//講座參加費用
            $table->string('participate_award');//參加獎勵
            $table->integer('point');//冒險點數
            $table->integer('max_people');//最大人數
            $table->integer('now_apply_people');//目前申請人數
            $table->integer('actual_completed_people');//實際完成人數
            $table->string('other_description');//其它說明
            $table->integer('status');//此活動的狀態(例如是否已結束、是否已經發佈、或是發佈中)
            $table->string('token');
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
        Schema::drop('lectures');
    }
}
