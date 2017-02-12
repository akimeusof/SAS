<?php

namespace App\Http\Controllers;
use App\Semester;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subject;
use App\User;
use App\Classroom;
use App\Validation;
use App\Enrollment;
class LecturerClassroomOperationController extends Controller
{
    public function newClassroom()
    {
        $currentSemester = Semester::current()->pluck('semester');
        $currentSemester_id = Semester::current()->pluck('semester_id');
        //subject utk dropdown list masa create class
        $subjects = Subject::select
        (\DB::raw("CONCAT(code, ' - ', name) AS subjects, subject_id"))
            ->where('status', 1)
            ->orderBy('name', 'asc')
            ->lists('subjects','subject_id');
        $user = \Auth::user();
        return view('users.lecturer.classes.newClassroom')
            ->with('currentSemester', $currentSemester)
            ->with('subjects', $subjects)
            ->with('currentSemester_id', $currentSemester_id);
//            ->with('user', $user);
    }
    public function viewAllClassroom()
    {
        $user = \Auth::user();
        $semesters = Semester::where('status', 1)->orderBy('start', 'asc')->get();
//        dd($semesters);
        $classrooms = Classroom::join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
                        ->join('semesters', 'classrooms.semester_id', '=', 'semesters.semester_id')
                        ->select('classrooms.*')
                        ->where('classrooms.user_id', $user->id)
                        ->where('classrooms.status', 1)
                        ->orderBy('semesters.semester', 'DESC')
                        ->orderBy('subjects.name', 'asc')
                        ->orderBy('classrooms.section', 'asc')
                        ->get();
        return view('users.lecturer.classes.viewAllClassroom')
            ->with('semesters', $semesters)
            ->with('classrooms', $classrooms)
            ->with('s_selected', 0);
    }
    
    public function viewAllClassroomFiltered(Request $request)
    {
        if($request->semester_id == null) {
            return back()->withErrors(['errors' => 'Please choose a semester to filter']);
        }else{
            if($request->semester_id == 0){
                return redirect()->action('LecturerClassroomOperationController@viewAllClassroom');
            }else{
                $user = \Auth::user();
                $semesterSelected = Semester::find($request->semester_id);
                $semesters = Semester::where('status', 1)->orderBy('start', 'asc')->get();
                $classrooms = Classroom::join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
                    ->join('semesters', 'classrooms.semester_id', '=', 'semesters.semester_id')
                    ->select('classrooms.*')
                    ->where('classrooms.user_id', $user->id, 'AND')
                    ->where('classrooms.semester_id', $request->semester_id, 'AND')
                    ->where('classrooms.status', 1)
                    ->orderBy('semesters.semester', 'DESC')
                    ->orderBy('subjects.name', 'asc')
                    ->orderBy('classrooms.section', 'asc')
                    ->get();
                return view('users.lecturer.classes.viewAllClassroom')
                    ->with('semesterSelected', $semesterSelected)
                    ->with('semesters', $semesters)
                    ->with('classrooms', $classrooms)
                    ->with('s_selected', 1);
            }
        }
    }
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    //save classroom details to db
    public function store(Request $request)
    {
//        dd($request->all());
        $this->validate($request, Validation::$lecturerCreateClassroomValidationRules);
        $classCheck = Classroom::where('subject_id', $request->subject, 'AND')->where('section', $request->section)->first();
        if($classCheck == null) {
            $lecturer_id = \Auth::user()->id;
            $lecturer = User::find($lecturer_id);
            $semester_id = $request->semester_id;
            $subject_id = $request->subject;
            $subject = Subject::find($subject_id);
            $semester_id = $request->semester_id;
            $enrollmentkey = $request->enrollmentkey;
            $enrollmentkeyenc = bcrypt($enrollmentkey);
            $section = $request->section;
            $sectionUpper = strtoupper($section);
            $capacity = $request->capacity;
            $status = 1;
            $section_uppercase = strtoupper($section);
            $create = Classroom::create([
                'user_id' => $lecturer_id,
                'subject_id' => $subject_id,
                'semester_id' => $semester_id,
                'enrollmentkey' => $enrollmentkeyenc,
                'section' => $section_uppercase,
                'capacity' => $capacity,
                'status' => 1
            ]);
//            $class = $lecturer->subjects()->attach(array($subject->subject_id => array('semester_id' => $semester_id, 'section' => $section_uppercase, 'enrollmentkey' => $enrollmentkeyenc, 'capacity' => $capacity, 'status' => $status)));
            if($create){
                \Session::flash('successMessage', 'Class '.$subject->name.' Section '.$sectionUpper.' successfully created.');
                return redirect()->action('LecturerClassroomOperationController@newClassroom');
            }
            else {
                return back()->withInput()->withErrors(['error' => 'Problem occurred during create process. Please try again later.']);
            }
        }
        else {
            return back()->withInput()->withErrors(['error' => 'Class already existed.']);
        }
    }

    //view class details
    public function show($id)
    {
        $user = \Auth::user();
        $classView = Classroom::find($id);
        $students = Enrollment::where('classroom_id', $classView->classroom_id)->get();
        return view('users.lecturer.classes.viewClassroom')->with('user', $user)->with('classView', $classView)->with('students', $students);
    }

    public function edit($id)
    {
        $user = \Auth::user();
        $classView = Classroom::find($id);
        $subjects = Subject::where('status', 1)->orderBy('name', 'asc')->get();
        return view('users.lecturer.classes.editClassroom')->with('user', $user)->with('classView', $classView)->with('subjects', $subjects);
    }

    public function update(Request $request, $id)
    {
        $classroom = Classroom::find($id);
        if($request->subject_id == "" && $request->section == "") {
            $update = $classroom->update([
                'capacity' => $request->capacity
            ]);
            if ($update) {
                \Session::flash('successMessage', 'Class details successfully updated.');
                return redirect()->action('LecturerClassroomOperationController@show', $classroom->classroom_id);
            }
            else {
                return back()->withInput()->withErrors(['errors' => 'Class details already existed. Please change the details.']);
            }


        }elseif($request->subject_id == "" && $request->section != null){
            $classroomCheck = Classroom::where('subject_id', $classroom->subject_id, 'AND')->where('section', $request->section, 'AND')->where('status', 1)->first();
            if($classroomCheck == null){
                $update = $classroom->update([
                    'section' => $request->section,
                    'capacity' => $request->capacity
                ]);
                if ($update) {
                    \Session::flash('successMessage', 'Class details successfully updated.');
                    return redirect()->action('LecturerClassroomOperationController@show', $classroom->classroom_id);
                }
            }else{
                return back()->withInput()->withErrors(['errors' => 'Class details already existed. Please change the details.']);
            }
        }elseif($request->subject_id != "" && $request->section == null){
            $classroomCheck = Classroom::where('subject_id', $request->subject_id, 'AND')->where('section', $classroom->section, 'AND')->where('status', 1)->first();
            if ($classroomCheck == null) {
                $update = $classroom->update([
                    'subject_id' => $request->subject_id,
                    'capacity' => $request->capacity
                ]);
                if ($update) {
                    \Session::flash('successMessage', 'Class details successfully updated.');
                    return redirect()->action('LecturerClassroomOperationController@show', $classroom->classroom_id);
                }
                return redirect()->action('LecturerClassroomOperationController@show', $classroom->classroom_id)->withErrors(['errors' => 'Problem occurred during update process. Please try again later.']);

            } else {
                return back()->withInput()->withErrors(['errors' => 'Class details already existed. Please change the details.']);
            }
        }
        else{
            $classroomCheck = Classroom::where('subject_id', $request->subject_id, 'AND')->where('section', $request->section, 'AND')->where('status', 1)->first();
            if ($classroomCheck == null) {
                $update = $classroom->update([
                    'subject_id' => $request->subject_id,
                    'section' => $request->section,
                    'capacity' => $request->capacity
                ]);
                if ($update) {
                    \Session::flash('successMessage', 'Class details successfully updated.');
                    return redirect()->action('LecturerClassroomOperationController@show', $classroom->classroom_id);
                }
                return redirect()->action('LecturerClassroomOperationController@show', $classroom->classroom_id)->withErrors(['errors' => 'Problem occurred during update process. Please try again later.']);

            } else {
                return back()->withInput()->withErrors(['errors' => 'Class details already existed. Please change the details.']);
            }
        }
    }

    public function editClassroomEnrollmentKey($id)
    {
        $classView = Classroom::find($id);
        return view('users.lecturer.classes.editClassroomEK')
            ->with('classView', $classView);
    }
    
    public function handleEditClassroomEnrollmentKey(Request $request)
    {
        $this->validate($request, [
            'current_enrollment_key' => 'required|min:8',
            'new_enrollment_key' => 'required|min:8',
            're_enter_current_enrollment_key' => 'required|min:8'

        ]);
        $currentkey = $request->current_enrollment_key;
        $newKey = $request->new_enrollment_key;
        $confirmKey = $request->re_enter_current_enrollment_key;
        $classView = Classroom::find($request->classroom_id);

        if(\Hash::check($currentkey, $classView->enrollmentkey)){
            if($newKey==$confirmKey){
                $update = $classView->update([
                   'enrollmentkey' => bcrypt($newKey)
                ]);
                if($update){
                    \Session::flash('successMessage', 'Class enrollment key successfully updated.');
                    return redirect()->action('LecturerClassroomOperationController@show', $classView->classroom_id);
                }else{
                    return redirect()->action('LecturerClassroomOperationController@show', $classView->classroom_id)->withErrors(['errors' => 'Error occurred during enrollment key update process. Please try again later.']);
                }
            }else{
                return back()->withInput()->withErrors(['errors' => 'The new enrollment key fields entered did not match with confirmation of new enrollment key.']);
            }
        }else{
            return back()->withInput()->withErrors(['errors' => 'The current enrollment key entered does not match']);
        }
    }
    public function destroy($id)
    {
        //
    }
}
