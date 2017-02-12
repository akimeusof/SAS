<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AssessmentAttempt;
use App\AssessmentQuestion;
use App\Assessment;


class LecturerCompareAnswerOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $studentSelected = AssessmentAttempt::find($id);
        $questions = AssessmentQuestion::where('assessment_id', $studentSelected->assessment->assessment_id, 'AND')->where('status', 1)->get();
//        dd($questions);
//        dd($countNoOfQuestion);
        $assessment = Assessment::find($studentSelected->assessment->assessment_id);
//        $classrooms = Classroom::join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
        $otherStudentsAttempted = AssessmentAttempt::join('studentprofiles', 'assessmentattempts.user_id', '=', 'studentprofiles.user_id')
            ->select('assessmentattempts.*')
            ->where('assessmentattempts.assessmentattempt_id', '!=', $studentSelected->assessmentattempt_id, 'AND')
            ->where('assessmentattempts.assessment_id', $studentSelected->assessment->assessment_id, 'AND')
            ->where('assessmentattempts.status', 1)
//            ->orderBy('studentprofiles.id', 'asc')
            ->orderBy('studentprofiles.name', 'asc')
            ->get();
        return view('users.lecturer.assessments.similarityIndex')
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
//        $classrooms = Classroom::join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
        $otherStudentsAttempted = AssessmentAttempt::join('studentprofiles', 'assessmentattempts.user_id', '=', 'studentprofiles.user_id')
            ->select('assessmentattempts.*')
            ->where('assessmentattempts.assessmentattempt_id', '!=', $studentSelected->assessmentattempt_id, 'AND')
            ->where('assessmentattempts.assessment_id', $studentSelected->assessment->assessment_id, 'AND')
            ->where('assessmentattempts.status', 1)
//            ->orderBy('studentprofiles.id', 'asc')
            ->orderBy('studentprofiles.name', 'asc')
            ->get();
        return view('users.lecturer.assessments.similarityIndex')
            ->with('studentSelected', $studentSelected)
            ->with('assessment', $assessment)
            ->with('otherStudentsAttempted', $otherStudentsAttempted)
            ->with('questions', $questions);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
