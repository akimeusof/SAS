<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Subject;
use App\LecturerProfile;
use App\Classroom;
use App\Validation;

class ClassroomOperationController extends Controller
{
    public function viewAllClassroom()
    {
//        $subjects = Subject::select
//            (\DB::raw("CONCAT(code, ' - ', name) AS subjects, subject_id"))
//            ->where('status', 1)
//            ->orderBy('name', 'asc')
//            ->lists('subjects','subject_id');

        //        $lecturers = LecturerProfile::select
//        (\DB::raw("CONCAT(id, ' - ', name) AS lecturers, user_id"))
//            ->orderBy('name', 'asc')
//            ->lists('lecturers','user_id');
        $subjects = Subject::where('status', 1)->orderBy('name', 'asc')->get();

        $classrooms = Classroom::join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
            ->join('semesters', 'classrooms.semester_id', '=', 'semesters.semester_id')
            ->select('classrooms.*')
            ->where('classrooms.status', 1)
            ->orderBy('subjects.name', 'asc')
            ->orderBy('classrooms.section', 'asc')
            ->orderBy('semesters.semester', 'desc')
            ->get();
//        $lectDisplay = User::all()->where('status', 1, 'AND')->where('type', 'lecturer');

        return view('users.admin.classes.viewAllClassroom')
            ->with('subjects', $subjects)
//            ->with('lecturers', $lecturers)
            ->with('classrooms', $classrooms)
            ->with('s_selected', 0);
    }

    public function viewAllClassroomFiltered(Request $request)
    {
//        dd($request->all());
        if($request->subject_id == null) {
            return back()->withErrors(['errors' => 'Please select a subject to filter.']);
        }
        else {
            if ($request->subject_id >= 1) {
                $subjectSelected = Subject::find($request->subject_id);
                $subjects = Subject::where('status', 1)->orderBy('name', 'asc')->get();
                $classrooms = Classroom::join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
                    ->where('classrooms.subject_id', $request->subject_id, 'AND')
                    ->where('classrooms.status', 1)
                    ->orderBy('subjects.name', 'asc')
                    ->orderBy('classrooms.section', 'asc')
                    ->get();
                return view('users.admin.classes.viewAllClassroom')
                    ->with('subjects', $subjects)
                    ->with('classrooms', $classrooms)
                    ->with('subjectSelected', $subjectSelected)
                    ->with('s_selected', 1);
            }
            else {
                return redirect()->action('ClassroomOperationController@viewAllClassroom');
                }
            }
    }

    public function newClassroom()
    {
        $subjects = Subject::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();
        $lecturers = User::join('lecturerprofiles', 'users.id', '=', 'lecturerprofiles.user_id')
            ->select('users.*')
            ->where('users.type', 'lecturer', 'AND')
            ->where('users.status', 1)
            ->orderBy('lecturerprofiles.name', 'asc')
            ->get();
        return view('users.admin.classes.newClassroom')
            ->with('lecturers', $lecturers)
            ->with('subjects', $subjects);
    }

    public function store(Request $request)
    {
        $this->validate($request, Validation::$adminCreateClassroomValidationRules);
        $lecturer_id = $request->lecturer;
        $lecturer = User::find($lecturer_id);
        $subject_id = $request->subject;
        $subject = Subject::find($subject_id);
        $enrollmentkey = $request->enrollmentkey;
        $enrollmentkeyenc = bcrypt($enrollmentkey);
        $section = $request->section;
        $capacity = $request->capacity;
        $status = 1;
        $class = $lecturer->subjects()->attach(array($subject->subject_id => array('section' => $section, 'enrollmentkey' => $enrollmentkeyenc, 'capacity' => $capacity, 'status' => $status)));

        \Session::flash('successMessage', 'Class successfully created.');
        return redirect()->action('ClassroomOperationController@viewAllClassroom');
    }

    public function show($id)
    {
       
    }

    public function edit($id)
    {
        $classToEdit = Classroom::find($id);
        $subjects = Subject::where('subject_id', '!=', $classToEdit->subject_id)
            ->where('status', 1)
            ->orderBy('name', 'asc')
            ->get();
        $lecturers = User::join('lecturerprofiles', 'users.id', '=', 'lecturerprofiles.user_id')
            ->select('users.*')
            ->where('users.type', 'lecturer', 'AND')
            ->where('users.id', '!=', $classToEdit->user_id, 'AND')
            ->where('users.status', 1)
            ->orderBy('lecturerprofiles.name', 'asc')
            ->get();

        $classrooms = Classroom::join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
            ->select('classrooms.*')
            ->where('classrooms.status', 1)
            ->orderBy('subjects.name', 'asc')
            ->orderBy('classrooms.section', 'asc')
            ->get();

        return view('users.admin.classes.editClassroom')
            ->with('subjects', $subjects)
            ->with('lecturers', $lecturers)
            ->with('classrooms', $classrooms)
            ->with('classToEdit', $classToEdit );
    }

    public function resetEnrollmentKey($id)
    {
        $classroom = Classroom::find($id);
        $subjectCode = $classroom->subject->code;
        $reset = $classroom->update([
           'enrollmentkey' => bcrypt($subjectCode)
        ]);
        if($reset) {
            \Session::flash('successMessage', 'Successfully reset enrollment key');
            return redirect()->action('ClassroomOperationController@viewAllClassroom');
        }else{
            return redirect()->action('ClassroomOperationController@viewAllClassroom')->withErrors(['errors' => 'Problem occurred during reset process. Please try again.']);
        }
    }

    public function index()
    {

    }

    public function create()
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }
    
    public function destroy($id)
    {
        //
    }
}
