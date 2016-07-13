<?php
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class quest_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quest')->delete();
		$faker = Faker::create();
		for($i=0;$i<50;$i++)
		{
        	DB::table('quest')->insert([
        	    'name' => $faker->sentence(6),
        	    'creator' => $faker->name,
        		'start_at' => $faker->date,
        		'end_at' => $faker->date,
        		'description' => $faker->realText,
        		'salary' => $faker->numberBetween(100,200),
        		'point' => $faker->numberBetween(5,20),
        		'activation' => '1',
        		'workforce' => $faker->numberBetween(1,10),
        		'catalog' => $faker->numberBetween(0,2),
        	]);
    	}
    }
}
