<?php
use App\Lecture;
use Faker\Factory;
use Illuminate\Database\Seeder;

class LecturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('lectures')->delete();
        $faker = Faker\Factory::create();
        for($i=0;$i<25;$i++){
        	$lecture = new Lecture;
        	$lecture->name = $faker->sentence();
        	$lecture->creator = $faker->name;
        	$lecture->speaker = $faker->name;
        	$lecture->apply_start_at = $faker->date;
        	$lecture->apply_end_at = $faker->date;
        	$lecture->execute_start_at = $faker->date;
        	$lecture->execute_end_at = $faker->date;
        	$lecture->place = $faker->country;
        	$lecture->description = $faker->realText;
        	$lecture->admission_fee = $faker->numberBetween(100,1000);
        	$lecture->participate_award = $faker->sentence;
        	$lecture->point = $faker->numberBetween(10,100);
        	$lecture->max_people = $faker->numberBetween(10,100);
        	$lecture->now_apply_people = 0;
        	$lecture->actual_completed_people = 0;
        	$lecture->other_description = $faker->realText;
        	$lecture->status = $faker->numberBetween(0,3);
        	$lecture->save();
        }
    }
}
