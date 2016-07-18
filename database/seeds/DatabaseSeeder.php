<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call('quest_seeder');
        //$this->call('dialog_seeder');
        DB::table('dialog')->delete();
    }
}
