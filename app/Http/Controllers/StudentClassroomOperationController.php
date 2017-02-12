<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\AssessmentAttempt;
use App\Semester;
use App\Subject;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Classroom;
use App\Enrollment;
use App\User;

class StudentClassroomOperationController extends Controller
{
    public function viewAllClassroom()
    {
        $currentSemester = Semester::current()->pluck('semester_id');
        $subjects = Subject::where('status', 1)->get();
        $classrooms = Classroom::join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
            ->where('classrooms.semester_id', $currentSemester, 'AND')
            ->where('classrooms.status', 1)
            ->orderBy('subjects.name', 'asc')
            ->orderBy('classrooms.section', 'asc')
            ->get();
        return view('users.student.classes.viewAllClassroom')
            ->with('classrooms', $classrooms)
            ->with('subjects', $subjects)
            ->with('filter', 0)
            ->with('currentSemester', $currentSemester);
    }

    public function viewAllClassroomFiltered(Request $request)
    {
        if($request->subject_id > 0) {
            $subject_id = $request->subject_id;
            $subjectToFilter = Subject::find($subject_id);
            $currentSemester = Semester::current()->pluck('semester_id');
            $subjects = Subject::where('status', 1)->get();
            $classrooms = Classroom::join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
                ->where('classrooms.semester_id', $currentSemester, 'AND')
                ->where('classrooms.subject_id', $subjectToFilter->subject_id, 'AND')
                ->where('classrooms.status', 1)
                ->orderBy('subjects.name', 'asc')
                ->orderBy('classrooms.section', 'asc')
                ->get();
            return view('users.student.classes.viewAllClassroom')
                ->with('classrooms', $classrooms)
                ->with('subjects', $subjects)
                ->with('subjectToFilter', $subjectToFilter)
                ->with('filter', 1);
        }
        elseif($request->subject_id == 0){
            return redirect()->action('StudentClassroomOperationController@viewAllClassroom');
        }
        else{
            return back()->withErrors(['errors' => 'Please Select a Subject to Filter.']);
        }
    }
    
    public function viewClassroom($id)
    {
        dd($id);
    }

    public function enrollClassroom(Request $id)
    {
        $classroom = Classroom::find($id);
        return view('users.student.classes.enrollClassroom')->with('classroom', $classroom);
    }

    public function viewEnrolledClassroom()
    {
        $user = User::find(\Auth::user()->id);
        $enrollments = Enrollment::join('classrooms', 'enrollments.classroom_id', '=', 'classrooms.classroom_id')
            ->join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
            ->select('enrollments.*')
            ->where('enrollments.user_id', $user->id, 'AND')
            ->where('enrollments.status', 1)
            ->orderBy('subjects.name', 'asc')
            ->orderBy('classrooms.section', 'asc')
            ->get();
        return view('users.student.classes.viewEnrolledClassroom')->with('enrollments', $enrollments);
    }

    public function classDetails($id)
    {
        $user = \Auth::user();
        $classroom = Classroom::find($id);
        $assessment_id_array = Array();
        $assessments = Assessment::where('classroom_id', $classroom->classroom_id)->get();
        foreach ($assessments as $assessment){
            $assessment_id_array[] = $assessment->assessment_id;
        }
        $attempted = AssessmentAttempt::join('assessments', 'assessmentattempts.assessment_id', '=', 'assessments.assessment_id')
            ->select('assessmentattempts.*')
            ->where('assessmentattempts.user_id', $user->id, 'AND')
            ->whereIn('assessmentattempts.assessment_id', $assessment_id_array)
            ->orderBy('assessments.assessmentname')
            ->get();
//        dd($attempted);
        return view('users.student.classes.viewEnrolledClassroomDetail')->with('classroom', $classroom)->with('attempted', $attempted);

        //untuk view class details
    }
    public function index($id)
    {
        echo "hahA";
    }

    public function create()
    {
        echo "haha";
    }

    //student enroll classroom
    public function store(Request $request)
    {
        $classroom = Classroom::find($request->classroom_id);
        $enrollmentkey = $request->enrollmentkey;
        $confirmenrollmentkey = $request->confirmenrollmentkey;
        if($enrollmentkey == $confirmenrollmentkey) {
            if (\Hash::check($enrollmentkey, $classroom->enrollmentkey)) {
                $enrollData = $request->only('user_id', 'classroom_id', 'status');
                $checkEnrolled = Enrollment::where('classroom_id', $request->classroom_id, 'AND')->where('user_id', $request->user_id, 'AND')->where('status', 1)->first();
                if(!$checkEnrolled) {
                    $enroll = Enrollment::create($enrollData);
                    if ($enroll) {
                        \Session::flash('successMessage', 'Successfully enrolled to ' . $classroom->subject->name . ' Section ' . $classroom->section . '.');
                        return redirect()->action('StudentClassroomOperationController@viewEnrolledClassroom');
                    }
                    return back()->withErrors(['errors' => 'Problem occurred during enrollment process.']);

                }
                return redirect()->action('StudentClassroomOperationController@viewAllClassroom')->withErrors(['errors' => 'You have already enrolled to this class.']);
            }
            return back()->withErrors(['errors' => 'Enrollment key is invalid']);
        }
        return back()->withErrors(['errors' => 'Enrollment key does not match.']);
    }

    //to show enrollment page
    public function show($id)
    {
//        dd($id);
        $classroom = Classroom::find($id);
//        dd($classroom->enrollmentkey);
//        dd($classroom);
        return view('users.student.classes.enrollClassroom')->with('classroom', $classroom);
    }

    public function edit($id)
    {
        $enrollment = Enrollment::find($id);
        $enrollment->status = 0;
        $enrollment->save();
        if($enrollment) {
            $class = $enrollment->classroom;
            \Session::flash('successMessage', 'You have successfully unenrolled from '.$class->subject->code." - ".$class->subject->name." Section ".strtoupper($class->section));
            return redirect()->action('StudentClassroomOperationController@viewEnrolledClassroom');
        }
        return back()->withErrors(['errors' => 'Problem occurred during unenrollment process.']);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {

    }
}
