<?php

namespace App\Http\Controllers;

use App\AssessmentAttempt;
use App\Semester;
use App\Validation;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Assessment;
use App\Classroom;
use DB;
use App\Question;
use App\AssessmentQuestion;
use Symfony\Component\CssSelector\Parser\Reader;

class LecturerAssessmentOperationController extends Controller
{
    //create assessments
    public function newAssessment()
    {
        $currentSemID = Semester::current()->pluck('semester_id');
        $user = \Auth::user();
        $classrooms = Classroom::join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
            ->where('classrooms.user_id', $user->id, 'AND')
            ->where('classrooms.semester_id', $currentSemID, 'AND')
            ->where('classrooms.status', 1)
            ->orderBy('subjects.name', 'asc')
            ->orderBy('classrooms.section', 'asc')
            ->get();

        return view('users.lecturer.assessments.newAssessment')->with('classrooms', $classrooms);
    }

    //create assessments
    public function store(Request $request)
    {
//        dd($request->except('_token'));
//        dd($request->assessmentmarks);
        $this->validate($request, Validation::$lecturerCreateAssessmentValidationRules);
//        $this->validate($request, Validation::$lecturerCreateAssessmentValidationRules);
        $data = $request->except('_token');
        $data['assessment_name'] = strtoupper($data['assessment_name']);
        $assessment_name = strtoupper($request->assessmentname);
        $assessment = Assessment::create([
            'classroom_id' => $data['classroom'],
            'assessmentname' => strtoupper($data['assessment_name']),
            'assessmentmarks' => $data['assessment_marks'],
            'numberofquestion' => $data['number_of_question'],
            'duration' => $data['time_limit'],
            'start' => $data['open_date']." ".$data['open_time'].":00",
            'end' => $data['close_date']." ".$data['close_time'].":00",
            'remarks' => $data['remarks'],
            'status' => 0,
            'revealmarks' => 0
        ]);
        if ($assessment) {
            \Session::flash('successMessage', 'Assessment ' . $assessment_name . ' successfully created.');
            $questions = Question::where('subject_id', $assessment->classroom->subject->subject_id, 'AND')->where('status', 1)->get();
            $assessment_id = $assessment->assessment_id;
//            return view("users.lecturer.assessments.newAssessmentQuestion")->with('assessments', $assessments)->with('questions', $questions);
            return redirect()->action('LecturerAssessmentOperationController@show', [$assessment_id]);
        }
        return redirect()->action('LecturerAssessmentOperationController@newAssessment')->$this->withErrors(['errors' => 'Problem occurred during create process.']);;
    }

    //view all assessments
    public function viewAllAssessment()
    {
        $currentSemID = Semester::current()->pluck('semester_id');
        $user = \Auth::user();
//        $classrooms = Classroom::where('user_id', $user->id)->orderBy('get();
        $classrooms = Classroom::join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
            ->where('classrooms.user_id', $user->id, 'AND')
            ->where('classrooms.status', 1)
            ->orderBy('subjects.name', 'asc')
            ->get();
        $semesters = Semester::where('status', 1)->orderBy('start', 'asc')->get();
        $assessments = Assessment::join('classrooms', 'assessments.classroom_id', '=', 'classrooms.classroom_id')
            ->join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
            ->join('semesters', 'classrooms.semester_id', '=', 'semesters.semester_id')
            ->select('assessments.*') //nak resolve problem bila column sama nama
            ->where('classrooms.user_id', $user->id, 'AND')
//            ->where('classrooms.semester_id', $currentSemID, 'AND')
            ->where('classrooms.status', 1)
            ->orderBy('subjects.name', 'asc')
            ->orderBy('classrooms.semester_id')
            ->orderBy('classrooms.section', 'asc')
            ->orderBy('assessments.assessmentname', 'asc')
            ->get();
        
        return view('users.lecturer.assessments.viewAllAssessment')
            ->with('assessments', $assessments)
            ->with('classrooms', $classrooms)
            ->with('semesters', $semesters)
            ->with('selected', 0);
    }

    public function viewAllAssessmentFiltered(Request $request)
    {
        if ($request->semester_id != null) {
            if($request->semester_id == 0){
                return redirect()->action('LecturerAssessmentOperationController@viewAllAssessment');
            }
            else {
                $semester_id = $request->semester_id;
                //class selected to filter
                $semesterSelected = Semester::find($semester_id);
                $semesters = Semester::where('status', 1, 'AND')->where('semester_id', '!=', $semester_id);
                $user = \Auth::user();
                //all other classroom to filter
//                $classrooms = Classroom::join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
//                    ->where('classrooms.user_id', $user->id, 'AND')
//                    ->where('classrooms.classroom_id', '!=', $classroomSelected->classroom_id, 'AND')
//                    ->where('classrooms.status', 1)
//                    ->orderBy('subjects.name', 'asc')
//                    ->get();
                $assessments = Assessment::join('classrooms', 'assessments.classroom_id', '=', 'classrooms.classroom_id')
                    ->join('subjects', 'classrooms.subject_id', '=', 'subjects.subject_id')
                    ->join('semesters', 'classrooms.semester_id', '=', 'semesters.semester_id')
                    ->select('assessments.*') //nak resolve problem bila column sama nama
                    ->where('classrooms.user_id', $user->id, 'AND')
                    ->where('classrooms.status', 1, 'AND')
                    ->where('classrooms.semester_id', $semester_id, 'AND')
                    ->orderBy('subjects.name', 'asc')
                    ->orderBy('classrooms.section', 'asc')
                    ->orderBy('assessments.assessmentname', 'asc')
                    ->get();
                return view('users.lecturer.assessments.viewAllAssessment')
                    ->with('assessments', $assessments)
                    ->with('classrooms', $semesters)
                    ->with('semesterSelected', $semesterSelected)
                    ->with('selected', 1);
            }
        }
        return back()->withErrors(['errors' => 'No semester selected to filter.']);
    }
    //untuk view assessments
    public function show($id)
    {
        $assessment = Assessment::find($id);
        $assessmentQuestions = AssessmentQuestion::join('questions', 'assessmentquestions.question_id', '=', 'questions.question_id')
            ->where('assessmentquestions.assessment_id', $assessment->assessment_id, 'AND')
            ->where('assessmentquestions.status', 1)
            ->orderBy('questions.chapter_no', 'asc')
            ->get();
        $studentsAttempted = AssessmentAttempt::join('studentprofiles', 'assessmentattempts.user_id', '=', 'studentprofiles.user_id')
            ->select('assessmentattempts.*')
            ->where('assessmentattempts.assessment_id', $assessment->assessment_id, 'AND')
            ->where('assessmentattempts.status', 1)
            ->orderBy('studentprofiles.name', 'asc')
            ->get();
//        dd($studentsAttempted);
//        dd($studentsAttempted->count());
        return view('users.lecturer.assessments.viewAssessment')
            ->with('assessment', $assessment)
            ->with('assessmentQuestions', $assessmentQuestions)
            ->with('studentsAttempted', $studentsAttempted);
    }

    //untuk nak pergi page edit assessments details
    public function edit($id)
    {
        $assessment = Assessment::find($id);
        if ($assessment) {
            return view('users.lecturer.assessments.editAssessment')->with('assessment', $assessment);
        }
        return back()->withErrors(['errors' => 'Assessment does not exist or data corrupted. Please create new.']);
    }

    public function update(Request $request, $id)
    {
//        dd($request->all());
        $assessment_id = $id;
        $assessment_name = strtoupper($request->assessmentname);
        $updateAssessment = Assessment::where('assessment_id', $assessment_id)
            ->update(
                [
                    'assessmentname' => strtoupper($request->assessment_name),
                    'assessmentmarks' => $request->assessment_marks,
                    'numberofquestion' => $request->number_of_question,
                    'duration' => $request->time_limit,
//                            'start' => $request['start_date'] . " " . $request['start_time'] . ":00",
//                            'end' => $request['end_date'] . " " . $request['end_time'] . ":00",
                            'remarks' => $request->remarks
                ]
            );
        if ($updateAssessment) {
            \Session::flash('successMessage', 'Assessment ' . strtoupper($request->assessment_name) . ' successfully updated.');
            return redirect()->action('LecturerAssessmentOperationController@show', $assessment_id);
        }
        return redirect()->action('LecturerAssessmentOperationController@show', $assessment_id)->withErrors(['errors' => 'Problem occurred during update process.']);
    }
    
    public function editAssessmentOpenDate($id)
    {
        $assessment = Assessment::find($id);
        return view('users.lecturer.assessments.editAssessmentOpenDate')->with('assessment', $assessment);
    }
    
    
    public function editAssessmentCloseDate($id)
    {
        $assessment = Assessment::find($id);
        return view('users.lecturer.assessments.editAssessmentCloseDate')->with('assessment', $assessment);
    }

    public function updateAssessmentOpenDate(Request $request, $id)
    {
        $assessment = Assessment::find($id);
        $this->validate($request, [
            'open_date' => 'required',
            'open_time' => 'required'
        ]);
        $update = Assessment::where('assessment_id', $id)->update([
            'start' => $request['open_date'] . " " . $request['open_time'] . ":00",
        ]);
        if($update){
            \Session::flash('successMessage', $assessment->assessmentname."'s open date successfully updated.");
            return redirect()->action('LecturerAssessmentOperationController@editAssessmentOpenDate', $assessment->assessment_id);
        }
        return back()->withErrors(['errors' => 'Error occurred during update process. Please try again later.']);
    }
    
    public function updateAssessmentCloseDate(Request $request, $id)
    {
        $assessment = Assessment::find($id);
        $this->validate($request, [
            'close_date' => 'required',
            'close_time' => 'required',
        ]);
        $update = Assessment::where('assessment_id', $id)->update([
            'end' => $request['close_date'] . " " . $request['close_time'] . ":00"
        ]);
        if($update){
            \Session::flash('successMessage', $assessment->assessmentname."'s close date successfully updated.");
            return redirect()->action('LecturerAssessmentOperationController@editAssessmentCloseDate', $assessment->assessment_id);
        }
    }

    public function updateAssessmentStatus(Request $request)
    {
        $changeStatus = $request->changeStatus;
        $assessment_id = $request->assessment_id;
        $assessment = Assessment::find($assessment_id);
        if($changeStatus == 1){
            $assessmentQuestions = AssessmentQuestion::where('assessment_id', $assessment_id)->get();
            $currentMarksInserted = $assessmentQuestions->sum('marks');
            if ($currentMarksInserted == $assessment->assessmentmarks) {
                $assessmentUpdate = Assessment::where('assessment_id', $assessment_id)->update(['status' => 1]);
                if ($assessmentUpdate) {
                    $assessment = Assessment::find($assessment_id);
                    $assessment_name = $assessment->assessmentname;
                    \Session::flash('successMessage', 'Assessment ' . $assessment_name . ' successfully activated.');
                    return redirect()->action('LecturerAssessmentOperationController@viewAllAssessment');
                }
                return back()->withErrors(['errors' => 'Problem occurred during activation process.']);
            } elseif ($currentMarksInserted < $assessment->assessmentmarks) {
                $insufficient = $assessment->assessmentmarks - $currentMarksInserted;
                return back()->withErrors(['errors' => 'Assessment marks for the questions is not sufficient by '.$insufficient.'. Please edit before proceeding.']);
            } else {
                return back()->withErrors(['errors' => 'Assessment marks for the questions is exceeding assessment marks limit. Please edit before proceeding.']);
            }
        }
        elseif($changeStatus == 0){
            $assessmentUpdate = Assessment::where('assessment_id', $assessment_id)->update(['status' => 0]);
            if($assessmentUpdate) {
                $assessment = Assessment::find($assessment_id);
                $assessment_name = $assessment->assessmentname;
                \Session::flash('successMessage', 'Assessment ' . $assessment_name . ' successfully deactivated.');
                return redirect()->action('LecturerAssessmentOperationController@viewAllAssessment');
            }
            return back()->withErrors(['errors' => 'Problem occurred during deactivation process.']);
        }
        else{
            return back();
        }

    }
    
    public function revealMarks($id)
    {
        $assessment = Assessment::find($id);
        if($assessment->revealmarks == 0) {
            $revealMarks = $assessment->update([
                'revealmarks' => 1
            ]);
            if ($revealMarks) {
                \Session::flash('successMessage', 'Assessment marks successfully revealed for student to view.');
                return redirect()->action('LecturerAssessmentOperationController@show', $assessment->assessment_id);
            } else {
                return redirect()->action('LecturerAssessmentOperationController@show', $assessment->assessment_id)
                    ->withErrors(['errors' => 'Problem occurred during reveal process. Please try again later.']);
            }
        }else{
            $unreveal = $assessment->update([
                'revealmarks' => 0
            ]);
            if ($unreveal) {
                \Session::flash('successMessage', 'Assessment marks successfully unrevealed from student to view.');
                return redirect()->action('LecturerAssessmentOperationController@show', $assessment->assessment_id);
            } else {
                return redirect()->action('LecturerAssessmentOperationController@show', $assessment->assessment_id)
                    ->withErrors(['errors' => 'Problem occurred during unrevealed process. Please try again later.']);
            }
        }
    }

    public function terminateAssessment($id)
    {
        $terminate = Assessment::destroy($id);
        if($terminate){
            \Session::flash('successMessage', 'Assessment successfully terminated.');
            return redirect()->action('LecturerAssessmentOperationController@viewAllAssessment');
        }
        return redirect()->action('LecturerAssessmentOperationController@viewAllAssessment')->withErrors(['errors' => 'Problem occurred during termination process. Please try again later.']);
    }
    public function assessmentSummary($id)
    {
        $assessment = Assessment::find($id);
        $studentsAttempted = AssessmentAttempt::where('assessment_id', $assessment->assessment_id)->get();
//        dd($studentsAttempted);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function destroy($id)
    {
        $assessment = Assessment::find($id);
        $deactivate = Assessment::where('assessment_id', $assessment->assessment_id)->update(['status' => 0]);
        if($deactivate){
            \Session::flash('successMessage', 'Assessment '.$assessment->assessmentname.' successfully deactivated.');
            return redirect()->action('LecturerAssessmentOperationController@viewAllAssessment');
        }
        return back()->withErrors(['errors' => 'Problem occurred during deactivation process.']);
    }
}
