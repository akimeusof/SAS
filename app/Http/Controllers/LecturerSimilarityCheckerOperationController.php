<?php

namespace App\Http\Controllers;

use App\AssessmentAttempt;
use App\AssessmentQuestion;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AssessmentAnswer;
use App\Assessment;

class LecturerSimilarityCheckerOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.lecturer.assessments.answers.try');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $studentSelected = AssessmentAttempt::find($id);
        $questions = AssessmentQuestion::where('assessment_id', $studentSelected->assessment->assessment_id, 'AND')->where('status', 1)->get();
//        dd($questions);
//        dd($countNoOfQuestion);
        $assessment = Assessment::find($studentSelected->assessment->assessment_id);
        $otherStudentsAttempted = AssessmentAttempt::join('studentprofiles', 'assessmentattempts.user_id', '=', 'studentprofiles.user_id')
            ->select('assessmentattempts.*')
            ->where('assessmentattempts.assessmentattempt_id', '!=', $studentSelected->assessmentattempt_id, 'AND')
            ->where('assessmentattempts.assessment_id', $studentSelected->assessment->assessment_id, 'AND')
            ->where('status', 1)
            ->orderBy('studentprofiles.name', 'asc')
            ->get();
        return view('users.lecturer.assessments.similarityChecker')
            ->with('studentSelected', $studentSelected)
            ->with('assessment', $assessment)
            ->with('otherStudentsAttempted', $otherStudentsAttempted)
            ->with('questions', $questions);
    }
    
    public function changeStudent(Request $request)
    {
        $studentSelected = AssessmentAttempt::find($request->assessmentattempt_id);
        $questions = AssessmentQuestion::where('assessment_id', $studentSelected->assessment->assessment_id, 'AND')->where('status', 1)->get();
        $assessment = Assessment::find($studentSelected->assessment->assessment_id);
        $otherStudentsAttempted = AssessmentAttempt::join('studentprofiles', 'assessmentattempts.user_id', '=', 'studentprofiles.user_id')
            ->select('assessmentattempts.*')
            ->where('assessmentattempts.assessmentattempt_id', '!=', $studentSelected->assessmentattempt_id, 'AND')
            ->where('assessmentattempts.assessment_id', $studentSelected->assessment->assessment_id, 'AND')
            ->where('assessmentattempts.status', 1)
            ->orderBy('studentprofiles.name', 'asc')
            ->get();
        return view('users.lecturer.assessments.similarityChecker')
            ->with('studentSelected', $studentSelected)
            ->with('assessment', $assessment)
            ->with('otherStudentsAttempted', $otherStudentsAttempted)
            ->with('questions', $questions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
//        $assessmentAnswer = AssessmentAnswer::find($id);
////        $myfile = fopen("testfile.txt", "w");
////        dd($assessmentAnswer->assessmentattempt->user->id);
//        $create = fopen("file.txt", "w") or die("Unable to create file.");
//        $text = $assessmentAnswer->s_answer;
//        $write = fwrite($create, $text);
////        $haha = file_put_contents($assessmentAnswer->assessmentattempt->user->id.".php", $assessmentAnswer->s_answer );
//        if($write){
//            return "haha";
//        }
//        return "fail";

        return view('users.lecturer.assessments.answers.try');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
