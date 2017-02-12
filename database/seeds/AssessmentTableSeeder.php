<?php

use Illuminate\Database\Seeder;
use App\Assessment;

class AssessmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assessments')->delete();

        //1
        Assessment::create([
            'classroom_id' => '1',
            'assessmentname' => 'Test 1',
            'assessmentmarks' => '30',
            'numberofquestion' => '3',
            'duration' => '1',
            'start' => '2016-09-25 14:00:00',
            'end' => '2016-09-26 14:00:00',
            'remarks' => 'This test include chapter 1 to 8.',
            'status' => '1',
            'revealmarks' => '0'
        ]);
        //2
        Assessment::create([
            'classroom_id' => '1',
            'assessmentname' => 'Test 2',
            'assessmentmarks' => '50',
            'numberofquestion' => '5',
            'duration' => '60',
            'start' => '2016-09-27 12:00:00',
            'end' => '2016-09-28 12:00:00',
            'remarks' => 'This test include chapter 9 to 15.',
            'status' => '0',
            'revealmarks' => '0'
        ]);
    }
}
