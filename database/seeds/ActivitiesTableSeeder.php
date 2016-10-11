<?php
use App\Activity;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('activities')->delete();
        $faker = Faker\Factory::create();
        for($i=0;$i<25;$i++){
        	$activity = new Activity;
        	$activity->name = $faker->sentence();
        	$activity->creator = $faker->name;
        	$activity->apply_start_at = $faker->date;
        	$activity->apply_end_at = $faker->date;
        	$activity->execute_start_at = $faker->date;
        	$activity->execute_end_at = $faker->date;
        	$activity->place = $faker->country;
        	$activity->description = $faker->realText;
        	$activity->admission_fee = $faker->numberBetween(100,1000);
        	$activity->participate_award = $faker->sentence;
        	$activity->point = $faker->numberBetween(10,100);
        	$activity->max_people = $faker->numberBetween(10,100);
        	$activity->now_apply_people = 0;
        	$activity->actual_completed_people = 0;
        	$activity->other_description = $faker->realText;
        	$activity->status = $faker->numberBetween(0,3);
        	$activity->save();
        }
    }
}
