<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('departments')->insert([
            'id' => '0',
            'name' => '自動化及控制研究所',
        ]);
        DB::table('departments')->insert([
            'id' => '1',
            'name' => '機械工程系(所)',
        ]);
        DB::table('departments')->insert([
            'id' => '2',
            'name' => '材料科學與工程系(所)',
        ]);
        DB::table('departments')->insert([
            'id' => '3',
            'name' => '營建工程系(所)',
        ]);
        DB::table('departments')->insert([
            'id' => '4',
            'name' => '化學工程系(所)',
        ]);
        DB::table('departments')->insert([
            'id' => '5',
            'name' => '電子工程系(所)',
        ]);
        DB::table('departments')->insert([
            'id' => '6',
            'name' => '電機工程系(所)',
        ]);
        DB::table('departments')->insert([
            'id' => '7',
            'name' => '資訊工程系(所)',
        ]);
        DB::table('departments')->insert([
            'id' => '8',
            'name' => '光電工程研究所',
        ]);
        DB::table('departments')->insert([
            'id' => '9',
            'name' => '管理研究所',
        ]);
        DB::table('departments')->insert([
            'id' => '10',
            'name' => '工業管理系(所)',
        ]);
        DB::table('departments')->insert([
            'id' => '11',
            'name' => '企業管理系(所)',
        ]);
        DB::table('departments')->insert([
            'id' => '12',
            'name' => '財務金融研究所',
        ]);
        DB::table('departments')->insert([
            'id' => '13',
            'name' => '資訊管理系(所)',
        ]);
        DB::table('departments')->insert([
            'id' => '14',
            'name' => '管理學院MBA',
        ]);
        DB::table('departments')->insert([
            'id' => '15',
            'name' => 'EMBA暨管研所博士班',
        ]);
        DB::table('departments')->insert([
            'id' => '16',
            'name' => '建築系(所)',
        ]);
        DB::table('departments')->insert([
            'id' => '17',
            'name' => '工商業設計系(所)',
        ]);
        DB::table('departments')->insert([
            'id' => '18',
            'name' => '數位學習與教育研究所',
        ]);
        DB::table('departments')->insert([
            'id' => '19',
            'name' => '應用外語系(所)',
        ]);
        DB::table('departments')->insert([
            'id' => '20',
            'name' => '應用科技研究所',
        ]);
        DB::table('departments')->insert([
            'id' => '21',
            'name' => '全校不分系學士班',
        ]);
        DB::table('departments')->insert([
            'id' => '22',
            'name' => '醫學工程研究所',
        ]);
        DB::table('departments')->insert([
            'id' => '23',
            'name' => '色彩與照明科技研究所',
        ]);
        DB::table('departments')->insert([
            'id' => '24',
            'name' => '應用科技學士學位學程',
        ]);
        DB::table('departments')->insert([
            'id' => '25',
            'name' => '科技管理研究所',
        ]);
        DB::table('departments')->insert([
            'id' => '26',
            'name' => '專利研究所',
        ]);
        DB::table('departments')->insert([
            'id' => '27',
            'name' => '科技管理學士學位學程',
        ]);
        DB::table('departments')->insert([
            'id' => '28',
            'name' => '智慧財產學士學位學程',
        ]);
    }
}
