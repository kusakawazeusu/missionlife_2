<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('creator');
            $table->date('apply_start_at'); //報名時間
            $table->date('apply_end_at');
            $table->date('execute_start_at'); //執行時間
            $table->date('execute_end_at');
            $table->string('place');//工作地點
            $table->string('description'); //任務描述
            $table->integer('salary');//薪資
            $table->integer('salary_type');//薪資格式(時薪、日薪、本次)
            $table->integer('point');//冒險點數
            $table->boolean('verification');//是否需要審核
            $table->integer('people_require');//需求人數
            $table->integer('max_apply_people');//申請人數上限
            $table->integer('now_apply_people');//目前申請人數
            $table->integer('actual_accepted_people');//實際接取人數
            $table->integer('actual_completed_people');//實際完成人數
            $table->string('other_description');//其它說明
            $table->integer('status');//此任務的狀態(例如是否已結束、是否已經發佈、或是發佈中)
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
        Schema::drop('quests');
    }
}
