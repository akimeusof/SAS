<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Assessment;
use App\AssessmentQuestion;
use App\Question;

class LecturerAssessmentQuestionRemoveOperationController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $assessment = Assessment::find($id);

        $questionsAdded = AssessmentQuestion::join('questions', 'assessmentquestions.question_id', '=', 'questions.question_id')
            ->select('assessmentquestions.*')
            ->where('assessmentquestions.assessment_id', $assessment->assessment_id, 'AND')
            ->where('assessmentquestions.status', 1)
            ->orderBy('questions.chapter_no')
            ->get();

//        $questionsAddedCount = $questionsAdded->count();

        $assessmentQuestion_id = AssessmentQuestion::where('assessment_id', $assessment->assessment_id)
            ->where('status', 1)
            ->get(['question_id']);

        $questions = Question::whereNotIn('question_id', $assessmentQuestion_id, 'AND')
            ->where('subject_id', $assessment->classroom->subject_id, 'AND')
            ->where('status', 1)->get();

        return view('users.lecturer.assessments.editAssessmentQuestion')
            ->with('assessment', $assessment)
            ->with('questions', $questions)
            ->with('questionsAdded', $questionsAdded);
    }

    public function update(Request $request, $id)
    {
        $questions = $request->assessmentquestion_id;
        $count = count($questions);
//        dd($questions);
        $assessment_id = $request->assessment_id;
        $assessment = Assessment::find($assessment_id);
//        dd($questions);
        if($questions != null) {
            foreach ($questions as $question) {
                $delete = AssessmentQuestion::destroy($question);
            }
            \Session::flash('successMessage', $count.' question(s) successfully removed from Assessment: '.$assessment->assessmentname);
            return redirect()->action('LecturerAssessmentQuestionRemoveOperationController@edit', $assessment_id);
        }
        return redirect()
            ->action('LecturerAssessmentQuestionRemoveOperationController@edit', $assessment_id)
            ->withErrors(['errors' => 'No questions were selected to be deleted']);
    }

    public function destroy($id)
    {
        //
    }
}
