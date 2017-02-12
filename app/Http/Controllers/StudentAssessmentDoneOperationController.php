<?php

namespace App\Http\Controllers;

use App\AssessmentAnswer;
use App\AssessmentAttempt;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\SWGCompare;

class StudentAssessmentDoneOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $assessmentanswer_id = $request->assessmentanswer_id;
        dd($assessmentanswer_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //page lepas dah submit/update answer
    public function show($id)
    {
        $assessmentAttemptData = AssessmentAttempt::find($id);
        $assessmentQsAs = AssessmentAnswer::where('assessmentattempt_id', $assessmentAttemptData->assessmentattempt_id)->get();
        foreach ($assessmentQsAs as $assessmentQA) {
            $similar_text = similar_text($assessmentQA->question->answer, $assessmentQA->s_answer, $percent);
            $swg = new SWGCompare();
            $swgCompare = $swg->compare($assessmentQA->question->answer, $assessmentQA->s_answer);
            $update = AssessmentAnswer::where('assessmentanswer_id', $assessmentQA->assessmentanswer_id)
                ->update([
                    'marks_sm' => number_format($percent, 2),
                    'marks_swg' => number_format($swgCompare*100, 2)
                ]);
        }
        return view('users.student.assessments.assessmentQuestionPaperDoneSubmit')
            ->with('assessmentAttemptData', $assessmentAttemptData)
            ->with('assessmentQsAs', $assessmentQsAs);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //page lepas submit answer //before edit //masukkan marks
    public function edit($id)
    {
        $assessmentAttemptData = AssessmentAttempt::find($id);
        $assessmentQsAs = AssessmentAnswer::where('assessmentattempt_id', $assessmentAttemptData->assessmentattempt_id)->get();
        return view('users.student.assessments.assessmentQuestionPaperDone')
            ->with('assessmentAttemptData', $assessmentAttemptData)
            ->with('assessmentQsAs', $assessmentQsAs);
        
        
//        $assessmentAttemptData = AssessmentAttempt::find($id);
//        $assessmentQsAs = AssessmentAnswer::where('assessmentattempt_id', $assessmentAttemptData->assessmentattempt_id)->get();
//        return view('users.student.assessments.assessmentQuestionPaperEdit')->with('assessmentAttemptData', $assessmentAttemptData)->with('assessmentQsAs', $assessmentQsAs);
//        dd($assessmentQsAs);
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
        return "haha";
//        dd($request->assessmentanswer_id);
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
