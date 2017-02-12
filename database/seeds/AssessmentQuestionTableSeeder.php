<?php

use Illuminate\Database\Seeder;
use App\AssessmentQuestion;

class AssessmentQuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assessmentquestions')->delete();
        //1
        AssessmentQuestion::create([
            'assessment_id' => 1,
            'question_id' => 1,
            'marks' => 10,
            'status' => 1
        ]);
        
        //2
        AssessmentQuestion::create([
            'assessment_id' => 1,
            'question_id' => 3,
            'marks' => 10,
            'status' => 1
        ]); 
        
        //3
        AssessmentQuestion::create([
            'assessment_id' => 1,
            'question_id' => 5,
            'marks' => 10,
            'status' => 1
        ]); 
        //4
        AssessmentQuestion::create([
            'assessment_id' => 2,
            'question_id' => 1,
            'marks' => 10,
            'status' => 1
        ]); 
        //5
        AssessmentQuestion::create([
            'assessment_id' => 2,
            'question_id' => 2,
            'marks' => 10,
            'status' => 1
        ]);
        
        //6
        AssessmentQuestion::create([
            'assessment_id' => 2,
            'question_id' => 3,
            'marks' => 10,
            'status' => 1
        ]);

        //7
        AssessmentQuestion::create([
            'assessment_id' => 2,
            'question_id' => 4,
            'marks' => 10,
            'status' => 1
        ]);

        //8
        AssessmentQuestion::create([
            'assessment_id' => 2,
            'question_id' => 5,
            'marks' => 10,
            'status' => 1
        ]);
    }
}
