<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\LecturerProfile;
use App\Subject;

class LecturerSubjectOperationController extends Controller
{
    public function viewAllSubject()
    {
        $subjects = Subject::all()->where('status', 1);
        $lecturers = User::all()->where('type', 'lecturer', 'AND')->where('status', 1);
        return view('users.lecturer.subjects.viewAllSubject')->with('subjects', $subjects)->with('lecturers', $lecturers);
    }
    public function index()
    {
//        return view('users.lecturer.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, Subject::$insertSubjectValidationRules);
        $data = $request->only('code', 'name', 'createdby', 'status'); //request kalau byk sgt pakai all()
        $subject = Subject::create($data);
        if($subject){
            \Session::flash('successMessage', 'Subject successfully added.');
            return redirect()->action('LecturerSubjectOperationController@viewAllSubject');
        }
        return redirect()->action('SubjectOperationController@viewAllSubject')->$this->withErrors(['errors' => 'Problem occurred during update process.']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
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
