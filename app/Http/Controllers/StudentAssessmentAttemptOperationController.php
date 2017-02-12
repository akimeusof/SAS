<?php

namespace App\Http\Controllers;

use App\AssessmentAnswer;
use App\Question;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Assessment;
use App\AssessmentQuestion;
use App\AssessmentAttempt;
use App\SWGCompare;
use App\User;

class StudentAssessmentAttemptOperationController extends Controller
{
    public function create()
    {
        //
    }
    public function index($id)
    {
        echo $id;
    }


    //show question paper to student
    public function show($id)
    {
        $assessment = Assessment::find($id);
        $user = \Auth::user();
        $checkAttempt = AssessmentAttempt::where('user_id', $user->id, 'AND')->where('assessment_id', $assessment->assessment_id, 'AND')->where('status', 1)->first();
        if($checkAttempt == null) {
            return back()->withErrors(['errors' => 'Please re-attempt this assessment.']);
        }
        else {
            $attempt_data = AssessmentAttempt::find($checkAttempt->assessmentattempt_id);
            $assessmentQuestions = AssessmentQuestion::where('assessment_id', $assessment->assessment_id, 'AND')
                ->where('status', 1)
                ->orderByRaw("RAND()")
                ->get();
            return view('users.student.assessments.assessmentQuestionPaper')
                ->with('user', $user)
                ->with('assessment', $assessment)
                ->with('attempt_data', $attempt_data)
                ->with('checkAttempt', $checkAttempt)
                ->with('assessmentQuestions', $assessmentQuestions);
        }
    }
    
    //save jawapan student 
    public function store(Request $request)
    {
        $assessmentquestion_id = $request->assessmentquestion_id;
        $assessmentAttemptData = AssessmentAttempt::find($request->assessmentattempt_id);
        $s_answer = $request->s_answer;
//        $compareMarks = Array();
        for($i = 0; $i<count($assessmentquestion_id); $i++){
            $assessmentQuestion = AssessmentQuestion::find($assessmentquestion_id[$i]);
            $compare = new SWGCompare();
            $compareSimilarity = $compare->compare($assessmentQuestion->question->answer, $s_answer[$i]);
            //convert compare to form markah * total marks
            $compareMarks = $compareSimilarity * $assessmentQuestion->marks;
            $assessmentAnswer = new AssessmentAnswer([
                'assessmentattempt_id' => $assessmentAttemptData->assessmentattempt_id,
                'assessmentquestion_id' => $assessmentQuestion->assessmentquestion_id,
                's_answer' => $s_answer[$i],
                'marks' => $compareMarks,
            ]);
            $save = $assessmentAnswer->save();
//            $assessmentQuestion = null;
//            $compareSimilarity = null;
            $compareMarks = null;
            unset($assessmentQuestion);
            unset($compareSimilarity);
//            unset($compareMarks);

        }
        if($save){
            \Session::flash('successMessage', 'Answers successfully saved.');
            return redirect()->route('s_assessmentDone', $assessmentAttemptData->assessmentattempt_id);
//            return redirect()->action('StudentAssessmentDoneOperationController@edit', $assessmentAttemptData->assessmentattempt_id);
//            echo "haha";

        }else {
            return back()->withInput()->withErrors(['errors' => 'Error occurred. Please try again later.']);
        }
    }

    //page after student submit paper assessment
    public function assessmentDone($id)
    {
//        dd($id);
        $assessmentAttemptData = AssessmentAttempt::find($id);
        $assessment = Assessment::find($assessmentAttemptData->assessment_id);
        $user = User::find($assessmentAttemptData->user_id);
        $answers = AssessmentAnswer::where('assessmentattempt_id', $assessmentAttemptData->assessmentattempt_id)->get();
        return view('users.student.assessments.assessmentQuestionPaperDoneSubmit')
            ->with('assessmentAttemptData', $assessmentAttemptData)
            ->with('answers', $answers);
    }
    

    public function edit($id)
    {
        $assessmentAttemptData = AssessmentAttempt::find($id);
        $assessmentQsAs = AssessmentAnswer::where('assessmentattempt_id', $assessmentAttemptData->assessmentattempt_id)->get();
        return view('users.student.assessments.assessmentQuestionPaperEdit')->with('assessmentAttemptData', $assessmentAttemptData)->with('assessmentQsAs', $assessmentQsAs);
    }
    
    public function update(Request $request, $id)
    {
        $assessmentAttemptData = AssessmentAttempt::find($id);
        $assessmentanswer_id = $request->assessmentanswer_id;
        $answer = $request->s_answer;
//        dd($assessmentanswer_id);
        $count = count($request->assessmentanswer_id);
        for($i = 0; $i<$count; $i++){
            $updateAnswer = AssessmentAnswer::where('assessmentanswer_id',$assessmentanswer_id[$i])
                ->update([
                    's_answer' => $answer[$i]
                ]);
        }
        if($updateAnswer){
            return redirect()->action('StudentAssessmentDoneOperationController@edit', $assessmentAttemptData->assessmentattempt_id);
        }
    }

    public function destroy($id)
    {
        //
    }
}
