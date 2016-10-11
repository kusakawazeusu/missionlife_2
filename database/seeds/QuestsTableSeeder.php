<?php
use App\Quest;
use Faker\Factory;
use Illuminate\Database\Seeder;

class QuestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('quests')->delete();
        $faker = Faker\Factory::create();
        for($i=0;$i<25;$i++){
        	$quest = new Quest;
        	$quest->name = $faker->sentence();
        	$quest->creator = $faker->name;
        	$quest->apply_start_at = $faker->date;
        	$quest->apply_end_at = $faker->date;
        	$quest->execute_start_at = $faker->date;
        	$quest->execute_end_at = $faker->date;
        	$quest->place = $faker->country;
        	$quest->description = $faker->realText;
        	$quest->salary = $faker->numberBetween(100,1000);
        	$quest->salary_type = $faker->numberBetween(0,2);
        	$quest->point = $faker->numberBetween(10,100);
        	$quest->verification = $faker->boolean;
        	$quest->people_require = $faker->numberBetween(10,100);
        	$quest->max_apply_people = $faker->numberBetween(10,100);
        	$quest->now_apply_people = 0;
        	$quest->actual_accepted_people = 0;
        	$quest->actual_completed_people = 0;
        	$quest->other_description = $faker->realText;
        	$quest->status = $faker->numberBetween(0,3);
        	$quest->save();
        }

    }
}
