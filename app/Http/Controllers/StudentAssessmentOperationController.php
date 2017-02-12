<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\AssessmentAnswer;
use App\AssessmentAttempt;
use App\AssessmentQuestion;
use App\Classroom;
use App\Enrollment;
use App\Subject;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StudentAssessmentOperationController extends Controller
{
    public function viewAllAssessment()
    {
        $user = \Auth::user();
        //nak amek list id of class enrolled by user
        $classesEnrolled_id = Enrollment::where('user_id', $user->id, 'AND')->where('status', 1)->lists('classroom_id')->toArray();
//        $subjects = Subject::where('status', 1)
        $assessmentsAvailable = Assessment::whereIn('assessments.classroom_id', $classesEnrolled_id)
            ->join('classrooms', 'assessments.classroom_id', '=', 'classrooms.classroom_id')
            ->join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
            ->select('assessments.*') //nak resolve problem bila column sama nama
//            ->where('assessments.status', 0)
            ->orderBy('subjects.code', 'asc')
            ->orderBy('classrooms.section', 'asc')
            ->orderBy('assessments.assessmentname', 'asc')
            ->orderBy('assessments.start', 'asc')
            ->orderBy('assessments.end', 'asc')
            ->get();
        
        return view('users.student.assessments.viewAllAssessment')->with('assessmentsAvailable', $assessmentsAvailable)->with('user', $user);
    }
    
    //view assessment before attempt
    public function show($id)
    {
        $assessment = Assessment::find($id);
        $user = \Auth::user();
        $checkAttempt = AssessmentAttempt::where('assessment_id', $assessment->assessment_id, 'AND')->where('user_id', $user->id, 'AND')->where('status', 1)->first();
        //check if answer exist, if answer tak exist boleh reattempt
        if($checkAttempt == null){
            return view('users.student.assessments.viewAssessment')->with('assessment', $assessment)->with('user', $user)->with('checkAttempt', null);
        }else {
            return view('users.student.assessments.viewAssessment')
                ->with('assessment', $assessment)
                ->with('user', $user)
                ->with('checkAttempt', $checkAttempt);
        }
    }

    public function index()
    {
        return "haha";
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

    }

    
    //to store assessment attempt data
    //return question paper
    public function edit($id)
    {
        $assessment = Assessment::find($id);
        $user = \Auth::user();
        //untuk nak tambah feature how many attempt a student can do. for now only once
        //$countAttempt = AssessmentAttempt::where('user_id', $user->id, 'AND')->where('assessment_id', $assessment->assessment_id, 'AND')->where('status', 1)->get()->count();
        $checkAttempt = AssessmentAttempt::where('user_id', $user->id, 'AND')->where('assessment_id', $assessment->assessment_id, 'AND')->where('status', 1)->first();
        if($checkAttempt == null) {
            $attempt = AssessmentAttempt::create([
                'user_id' => $user->id,
                'assessment_id' => $assessment->assessment_id,
                'status' => 1
            ]);
            if ($attempt) {
//                $assessmentQuestions = AssessmentQuestion::where('assessment_id', $assessment->assessment_id, 'AND')->where('status', 1)->get();
//                return view('users.student.assessments.assessmentQuestionPaper')
//                    ->with('user', $user)
//                    ->with('assessment', $assessment)
//                    ->with('assessmentQuestions', $assessmentQuestions);
                return redirect()->action('StudentAssessmentAttemptOperationController@show', $assessment->assessment_id);
            }
            return "fail to attempt";
        }
        return back()->withErrors(['errors' => 'You have already attempted this assessment.']);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
    public function s_test()
    {
        
    }
}
