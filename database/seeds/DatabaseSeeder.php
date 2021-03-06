<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        //$this->call('quest_seeder');
        $this->call('QuestsTableSeeder');
        $this->call('ActivitiesTableSeeder');
        $this->call('LecturesTableSeeder');
        // $this->call('DepartmentsTableSeeder');
        //$this->call('dialog_seeder');
        //DB::table('dialog')->delete();
    }
}
