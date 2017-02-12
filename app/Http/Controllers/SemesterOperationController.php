<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Semester;

class SemesterOperationController extends Controller
{
    public function semesters()
    {
        $semesters = Semester::where('status', 1)->orderBy('start', 'asc')->get();
        return view('users.admin.semesters.viewAllSemesters')->with('semesters',$semesters);
    }

    public function store(Request $request)
    {
//        dd($request->start_date);
        $this->validate($request, [
            'semester_name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);
        if($request->start_date )
        $insert = Semester::create([
            'semester' => $request->semester_name,
            'start' => $request->semester_name,
            'end' => $request->semester_name,
            'status' => 1
        ]);
        if($insert){
            \Session::flash('successMessage', 'Semester successfully created.');
            return redirect()->action('SemesterOperationController@semesters');
        }else{
            return back()->withInput()->withError(['errors' => 'Error occurred during insert process. Please try again later.']);
        }
    }
    public function edit($id)
    {
        $semesterSelected = Semester::find($id);
        $semesters = Semester::where('status', 1)->orderBy('start', 'asc')->get();;
        return view('users.admin.semesters.editSemester')->with('semesters',$semesters)->with('semesterSelected', $semesterSelected);
    }

    public function update(Request $request, $id)
    {
        $semester = Semester::find($id);
        $update = $semester->update([
           'semester' => $request->semester_name,
            'start' => $request->start_date,
            'end' => $request->end_date
        ]);
        if($update){
            \Session::flash('successMessage', 'Semester successfully updated.');
            return redirect()->action('SemesterOperationController@semesters');
        }else {
            return redirect()->action('SemesterOperationController@semesters')->withErrors(['errors' => 'Error occurred during update process. Please try again later.']);
        }
    }

    public function destroy($id)
    {
        $semester = Semester::find($id);
        $delete = $semester->update([
            'status' => 0
        ]);
        if($delete){
            \Session::flash('successMessage', 'Semester successfully removed.');
            return redirect()->action('SemesterOperationController@semesters');
        }else {
            return redirect()->action('SemesterOperationController@semesters')->withErrors(['errors' => 'Error occurred during update process. Please try again later.']);
        }
    }
}
