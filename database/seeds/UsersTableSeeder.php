<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'name' => '余浩安',
            'email' => '123@mail.ntust.edu.tw',
            'password' => bcrypt('123123'),
            'picture_path' => 'default_img.jpg',
            'activation' => '1',
            'department_id' => '7',
            'auth'=>'0',
        ]);
        DB::table('users')->insert([
            'name' => '余npc',
            'email' => 'npc@mail.ntust.edu.tw',
            'password' => bcrypt('123123'),
            'picture_path' => 'default_img.jpg',
            'activation' => '1',
            'department_id' => '7',
            'auth'=>'1',
        ]);
        DB::table('users')->insert([
            'name' => '余gm',
            'email' => 'gm@mail.ntust.edu.tw',
            'password' => bcrypt('123123'),
            'picture_path' => 'default_img.jpg',
            'activation' => '1',
            'department_id' => '7',
            'auth'=>'2',
        ]);

    }
}
