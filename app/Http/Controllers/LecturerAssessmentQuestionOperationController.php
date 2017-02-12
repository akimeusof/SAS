<?php

namespace App\Http\Controllers;

use App\SubjectChapter;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Assessment;
use App\AssessmentQuestion;
use App\Question;

class LecturerAssessmentQuestionOperationController extends Controller
{
    public function index()
    {
        //
    }

    //lepas insert questions in assessment, go to insert marks
    public function create($id)
    {
        $assessment = Assessment::find($id);
//        dd($assessments);
        $questionsAdded = AssessmentQuestion::join('questions', 'assessmentquestions.question_id', '=', 'questions.question_id')
            ->select('assessmentquestions.*')
            ->where('assessmentquestions.assessment_id', $assessment->assessment_id, 'AND')
            ->where('assessmentquestions.status', 1)
            ->orderBy('questions.chapter_no', 'asc')
            ->get();

//        $questionsAddedCount = $questionsAdded->count();

        $assessmentQuestion_id = AssessmentQuestion::where('assessment_id', $assessment->assessment_id)
            ->where('status', 1)
            ->get(['question_id']);

        $questions = Question::whereNotIn('question_id', $assessmentQuestion_id)->where('status', 1)->get();

        return view('users.lecturer.assessments.manageAssessmentQuestionMarks')
            ->with('assessment', $assessment)
            ->with('questions', $questions)
            ->with('questionsAdded', $questionsAdded);
    }

    //process insert marks for specific questions
    public function handleAssessmentQuestionMarks(Request $request)
    {
//        dd($request->assessment_id);
        $assessmentQuestions = $request->assessmentquestion_id;
        $marks = $request->marks;
        for($i = 0; $i<count($assessmentQuestions);$i++){
            if($marks[$i] != 0) {
                $a_q = AssessmentQuestion::find($assessmentQuestions[$i]);
                if($marks[$i] != $a_q->marks)
                $update = AssessmentQuestion::find($assessmentQuestions[$i])->update([
                    'marks' => $marks[$i]
                ]);
            }
        }
        \Session::flash('successMessage', 'Marks successfully stored.');
//        echo "okay";
        return redirect()->action('LecturerAssessmentQuestionOperationController@show', $request->assessment_id);
    }
    

    //nak masuk kan data for question that belong to each assessments
    public function store(Request $request)
    {
//        dd($request->all());
        $questions = $request->question_id;
        $assessment_id = $request->assessment_id;
        $assessment = Assessment::find($assessment_id);
        $assessmentQuestions = AssessmentQuestion::where('assessment_id', $assessment->assessment_id, 'AND')->where('status', 1)->get();
        $count = count($assessmentQuestions);
        $countNew = count($questions);
        $total = $count+$countNew;
        if ($total <= $assessment->numberofquestion) {
            if ($questions != null) {
                for($i = 0;$i<count($questions); $i++){
                    if($questions[$i] != 0) {
                        $add = new AssessmentQuestion([
                            'assessment_id' => $assessment_id,
                            'question_id' => $questions[$i],
                            'status' => 1
                        ]);
                        $add->save();
                    }

                }
                if ($add->save()) {
                    \Session::flash('successMessage', 'Questions successfully added to Assessment: ' . $assessment->assessmentname . ".");
                    return redirect()->action('LecturerAssessmentQuestionOperationController@create', $assessment_id);
                }
            }
            //questions null, means non selected masa add
            return redirect()->action('LecturerAssessmentQuestionOperationController@show', $assessment_id)->withErrors(['errors' => 'No questions selected.']);
        }
        return redirect()->action('LecturerAssessmentQuestionOperationController@show', $assessment_id)->withErrors(['errors' => 'You have exceeded the limit. Reduce questions in order to proceed.']);
    }

    //untuk page manage assessments question
    public function show($id)
    {
        $assessment = Assessment::find($id);
        $questionsAdded = AssessmentQuestion::join('questions', 'assessmentquestions.question_id', '=', 'questions.question_id')
            ->select('assessmentquestions.*')
            ->where('assessmentquestions.assessment_id', $assessment->assessment_id, 'AND')
            ->where('assessmentquestions.status', 1)
            ->orderBy('questions.chapter_no', 'asc')
            ->get();

//        $questionsAddedCount = $questionsAdded->count();

        $assessmentQuestion_id = AssessmentQuestion::where('assessment_id', $assessment->assessment_id)
            ->where('status', 1)
            ->get(['question_id']);

        $questions = Question::whereNotIn('question_id', $assessmentQuestion_id)->where('status', 1)->get();

        return view('users.lecturer.assessments.manageAssessmentQuestion')
            ->with('assessment', $assessment)
            ->with('questions', $questions)
            ->with('questionsAdded', $questionsAdded);
    }

    //untuk page nak add assessments questions
    public function edit($id)
    {
        $user = \Auth::user();
        $assessment = Assessment::find($id);
        $questionsAdded = AssessmentQuestion::join('questions', 'assessmentquestions.question_id', '=', 'questions.question_id')
            ->select('assessmentquestions.*')
            ->where('assessmentquestions.assessment_id', $assessment->assessment_id, 'AND')
            ->where('assessmentquestions.status', 1)
            ->orderBy('questions.chapter_no', 'asc')
            ->get();

//        $questionsAddedCount = $questionsAdded->count();

        $assessmentQuestion_id = AssessmentQuestion::where('assessment_id', $assessment->assessment_id)
            ->where('status', 1)
            ->get(['question_id']);

        //private questions
        $privateQuestions = Question::whereNotIn('question_id', $assessmentQuestion_id, 'AND')
            ->where('subject_id', $assessment->classroom->subject_id, 'AND')
            ->where('user_id', $user->id, 'AND')
            ->where('status', 1)
            ->orderBy('questions.chapter_no')
            ->get();
        //public questions
        $questions = Question::whereNotIn('question_id', $assessmentQuestion_id, 'AND')
            ->where('subject_id', $assessment->classroom->subject_id, 'AND')
            ->where('use_type', 1, 'AND')
            ->where('user_id', '!=', $user->id, 'AND')
            ->where('status', 1)
            ->orderBy('questions.chapter_no')
            ->get();

        return view('users.lecturer.assessments.addAssessmentQuestion')
            ->with('assessment', $assessment)
            ->with('questions', $questions)
            ->with('questionsAdded', $questionsAdded)
            ->with('privateQuestions', $privateQuestions);
    }

    //untuk nak pergi page remove questions
    public function update(Request $request, $id)
    {
        $assessment = Assessment::find($id);

        $questionsAdded = AssessmentQuestion::join('questions', 'assessmentquestions.question_id', '=', 'questions.question_id')
            ->where('assessmentquestions.assessment_id', $assessment->assessment_id, 'AND')
            ->where('assessmentquestions.status', 1)
            ->orderBy('questions.chapter')
            ->get();

        return view('users.lecturer.assessments.editAssessmentQuestion')
            ->with('assessments', $assessment)
            ->with('questionsAdded', $questionsAdded);
        
    }

    public function destroy($id)
    {

    }
}
