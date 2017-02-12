<?php

namespace App\Http\Controllers;

use App\SubjectChapter;
use App\Validation;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subject;
use App\LecturerProfile;

class SubjectOperationController extends Controller
{
    public function viewAllSubject()
    {
        $subjects = Subject::where('status', 1)->orderBy('name', 'asc')->get();
        return view('users.admin.subjects.viewAllSubject')->with('subjects', $subjects);
    }

    public function store(Request $request)
    {
        $this->validate($request, Validation::$insertSubjectValidationRules);
        if($request->totalchapter != null){
            $data = $request->only('code', 'name', 'totalchapter', 'status'); //request kalau byk sgt pakai all()
            $subject = Subject::create($data);
            if($subject){
                \Session::flash('successMessage', 'Subject successfully added.');
                return redirect()->action('SubjectOperationController@viewAllSubject');
            }
            return redirect()->action('SubjectOperationController@viewAllSubject')->$this->withErrors(['errors' => 'Problem occurred during update process.']);
        }
        else{
            return back()->withInput()->withErrors(['errors' => 'Please choose total chapter for this subject.']);
        }
    }

    public function viewChapters($id)
    {
        $subject = Subject::find($id);
        $chapters = SubjectChapter::where('subject_id', $subject->subject_id)->orderBy('chapter_no', 'asc')->get();
        return view('users.admin.subjects.viewChapters')->with('subject', $subject)->with('chapters', $chapters);
    }
    
    public function addChapters($id)
    {
        $subject = Subject::find($id);
        $chapters = SubjectChapter::where('subject_id', $subject->subject_id)->orderBy('chapter_no', 'asc')->get();
        return view('users.admin.subjects.addChapters')->with('subject', $subject)->with('chapters', $chapters);
        
    }

    public function editChapters($id)
    {

    }

    public function handleEditChapters(Request $request)
    {

    }

    public function deleteChapter($id)
    {
        
    }
    
    public function subjectChapters($id)
    {
        $subject = Subject::find($id);
        return view('users.admin.subjects.editChapter')->with('subject', $subject);
    }
    public function edit($id)
    {
        $subject = Subject::find($id);
        $subjects = Subject::all()->where('status', 1);
        return view('users.admin.subjects.editSubject', array('subject' => $subject))->with('subjects', $subjects);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
           'code' => 'required|unique:subjects,code,'.$id.',subject_id'
        ]);
        $subject = Subject::find($id);
        $subject->code = $request->code;
        $subject->name = $request->name;
        $subject->save();

        if($subject){
            \Session::flash('successMessage', 'Subject successfully updated.');
            return redirect()->action('SubjectOperationController@viewAllSubject');
        }
        return redirect()->action('SubjectOperationController@viewAllSubject')->$this->withErrors(['errors' => 'Problem occurred during update process.']);
    }

    public function destroy($id)
    {
        $subject = Subject::find($id);
        $subject->status = 0;
        $subject->save();

        if ($subject) {
            \Session::flash('successMessage', 'Subject successfully deleted.');
            return redirect()->action('SubjectOperationController@viewAllSubject');
        }
    }
}
