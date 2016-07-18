<?php
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class dialog_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dialog')->delete();
     	
        $faker = Faker::create();

        $order = array(0,0,0,0,0,0);

        for($i=0;$i<50;$i++)
        {
        	$temp = $faker->numberBetween(0,5);
        	if($temp == 0)
        	{
        		DB::table('dialog')->insert([
        			'ordered' => $order[0],
        			'ocassion' => 'first',
        			'pic_path' => '1.png',
        			'name' => '浩安',
        			'context' => $faker->realText,
        			]);
        		$order[0]++;
        	}
        	elseif($temp == 1)
        	{
        		DB::table('dialog')->insert([
        			'ordered' => $order[1],
        			'ocassion' => 'sec',
        			'pic_path' => '2.png',
        			'name' => '芃慥',
        			'context' => $faker->realText,
        			]);
        		$order[1]++;
        	}
        	elseif($temp == 2)
        	{
        		DB::table('dialog')->insert([
        			'ordered' => $order[2],
        			'ocassion' => 'third',
        			'pic_path' => '3.png',
        			'name' => '穎桑',
        			'context' => $faker->realText,
        			]);
        		$order[2]++;
        	}
        	elseif($temp == 3)
        	{
        		DB::table('dialog')->insert([
        			'ordered' => $order[3],
        			'ocassion' => 'fourth',
        			'pic_path' => '4.png',
        			'name' => '冠廷',
        			'context' => $faker->realText,
        			]);
        		$order[3]++;
        	}
        	elseif($temp == 4)
        	{
        		DB::table('dialog')->insert([
        			'ordered' => $order[4],
        			'ocassion' => 'fifth',
        			'pic_path' => '5.png',
        			'name' => '安安',
        			'context' => $faker->realText,
        			]);
        		$order[4]++;
        	}
        	elseif($temp == 5)
        	{
        		DB::table('dialog')->insert([
        			'ordered' => $order[5],
        			'ocassion' => 'sixth',
        			'pic_path' => '6.png',
        			'name' => '敦義',
        			'context' => $faker->realText,
        			]);
        		$order[5]++;
        	}
        }

    }
}
