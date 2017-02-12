<?php

namespace App\Http\Controllers;

use App\SubjectChapter;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Question;

class LecturerQuestionOperationController extends Controller
{
    public function addQuestion()
    {
        $user = \Auth::user();
        $subjects = Subject::where('status', 1)->orderBy('name', 'asc')->get();
        return view('users.lecturer.questions.addQuestion')->with('selected', 0)->with('subjects', $subjects);
    }
    
    public function addQuestionSelected(Request $request)
    {
        $subjectSelected = Subject::find($request->subject_id);
        $chapters = SubjectChapter::where('subject_id', $subjectSelected->subject_id)->get();
        return view('users.lecturer.questions.addQuestion')
            ->with('selected', 1) //indicate subject selected
            ->with('subjectSelected', $subjectSelected)
            ->with('chapters', $chapters);
    }

    public function handleAddQuestion(Request $request)
    {
      dd($request->all());
    }
    //view All question, subject not yet filtered
    public function viewAllQuestions(){
        $subjects = Subject::where('status' ,1)
            ->orderBy('name', 'asc')
            ->get();
        $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
            ->where('questions.use_type', 1, 'AND')
            ->where('questions.status', 1)
            ->orderBy('subjects.name', 'asc')
            ->orderBy('questions.chapter_no', 'asc')
            ->get();
        return view('users.lecturer.questions.viewAllQuestion')
            ->with('questions', $questions)
            ->with('subjects', $subjects)
            ->with('filter', 0);
    }
    
    public function viewAllQuestionsSelected(Request $request){
//        dd($request->all());
        $user = \Auth::user();
        if($request->subject_id == null){
            return redirect()->action('LecturerQuestionOperationController@viewAllQuestions')->withErrors(['errors' => 'No Subject Selected.']);
        }else {
            if($request->chapter == null) {
                $subjectSelected = Subject::find($request->subject_id);
                $subjects = Subject::where('status', 1)
                    ->orderBy('name', 'asc')
                    ->get();
                $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
                    ->where('questions.user_id', $user->id, 'AND')
                    ->where('questions.subject_id', $request->subject_id, 'AND')
                    ->where('questions.use_type', 1, 'AND')
                    ->where('questions.status', 1)
                    ->orderBy('subjects.name', 'asc')
                    ->orderBy('questions.chapter_no', 'asc')
                    ->get();
                return view('users.lecturer.questions.viewAllQuestion')
                    ->with('questions', $questions)
                    ->with('user', $user)
                    ->with('subjectSelected', $subjectSelected)
                    ->with('subjects', $subjects)
                    ->with('filter', 1);
            }elseif($request->chapter == 0){
                $subjectSelected = Subject::find($request->subject_id);
                $subjects = Subject::where('status', 1)
                    ->orderBy('name', 'asc')
                    ->get();
                $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
                    ->where('questions.user_id', $user->id, 'AND')
                    ->where('questions.subject_id', $request->subject_id, 'AND')
                    ->where('questions.use_type', 1, 'AND')
                    ->where('questions.status', 1)
                    ->orderBy('subjects.name', 'asc')
                    ->orderBy('questions.chapter_no', 'asc')
                    ->get();
                return view('users.lecturer.questions.viewAllQuestion')
                    ->with('questions', $questions)
                    ->with('user', $user)
                    ->with('subjectSelected', $subjectSelected)
                    ->with('subjects', $subjects)
                    ->with('filter', 1);
            }
            else{
                $subjectSelected = Subject::find($request->subject_id);
                $chapterSelected = $request->chapter;
                $subjects = Subject::where('status', 1)
                    ->orderBy('name', 'asc')
                    ->get();
                $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
                    ->where('questions.user_id', $user->id, 'AND')
                    ->where('questions.subject_id', $request->subject_id, 'AND')
                    ->where('questions.chapter_no', $chapterSelected, 'AND')
                    ->where('questions.use_type', 1, 'AND')
                    ->where('questions.status', 1)
                    ->orderBy('subjects.name', 'asc')
                    ->orderBy('questions.chapter_no', 'asc')
                    ->get();
                return view('users.lecturer.questions.viewAllQuestion')
                    ->with('questions', $questions)
                    ->with('user', $user)
                    ->with('subjectSelected', $subjectSelected)
                    ->with('subjects', $subjects)
                    ->with('filter', 1);
            }
        }
    }

    //new question subject not yet selected
    public function create() 
    {
        $user = \Auth::user();
        $subjects = Subject::where('status', 1)->orderBy('name', 'asc')->get();
        $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
            ->where('questions.user_id', $user->id, 'AND')
            ->where('questions.status', 1)
            ->orderBy('subjects.name', 'asc')
//            ->orderBy('questions.use_type', 'asc')
            ->orderBy('questions.chapter_no', 'asc')
            ->get();
    
        return view('users.lecturer.questions.newQuestion')
            ->with('subjects', $subjects)
            ->with('questions', $questions)
            ->with('user', $user)
            ->with('selected', 0) //for subject utk create soalan
            ->with('filter', 0);//untuk filter questions 0 tak filter
    }

    //filter question to display masa create question before choose subject
    public function createFiltered(Request $request)
    {
//        dd($request->chapter);
        if($request->subjectFilter != 0) { //kalau 0 no filter, question all subj
            if($request->chapter == 0){
                $subjectSelected = Subject::find($request->subjectFilter);
                $user = \Auth::user();
                $subjects = Subject::where('status', 1)->orderBy('name', 'asc')->get();
                $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
                    ->where('questions.user_id', $user->id, 'AND')
                    ->where('questions.subject_id', $subjectSelected->subject_id, 'AND')
                    ->where('questions.status', 1)
                    ->orderBy('subjects.name', 'asc')
                    ->orderBy('questions.chapter_no', 'asc')
                    ->get();
//                  $chapters = $subjectSelected
                return view('users.lecturer.questions.newQuestion')
                    ->with('subjects', $subjects)
                    ->with('questions', $questions)
                    ->with('user', $user)
                    ->with('selected', 0) //determine subj selected to insert new question 0 not
                    ->with('filter', 1)
                    ->with('chapter', 0)
                    ->with('subjectSelected', $subjectSelected); //determine filter or not 1 yes

            }else{
                $subjectSelected = Subject::find($request->subjectFilter);
                $user = \Auth::user();
                $subjects = Subject::where('status', 1)->orderBy('name', 'asc')->get();
                $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
                    ->where('questions.user_id', $user->id, 'AND')
                    ->where('questions.subject_id', $subjectSelected->subject_id, 'AND')
                    ->where('questions.chapter_no', $request->chapter, 'AND')
                    ->where('questions.status', 1)
                    ->orderBy('subjects.name', 'asc')
                    //            ->orderBy('questions.use_type', 'asc')
                    ->orderBy('questions.chapter_no', 'asc')
                    ->get();

                return view('users.lecturer.questions.newQuestion')
                    ->with('subjects', $subjects)
                    ->with('questions', $questions)
                    ->with('user', $user)
                    ->with('selected', 0) //determine subj selected to insert new question 0 not
                    ->with('filter', 1)
                    ->with('chapter', 0)
                    ->with('subjectSelected', $subjectSelected); //determine filter or not 1 yes
            }
        }else {
            //from filtered to all
            $user = \Auth::user();
            $subjects = Subject::where('status', 1)->orderBy('name', 'asc')->get();
            $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
                ->where('questions.user_id', $user->id, 'AND')
//            ->where('questions.subject_id', $subjectSelected->subject_id, 'AND')
                ->where('questions.status', 1)
                ->orderBy('subjects.name', 'asc')
//            ->orderBy('questions.use_type', 'asc')
                ->orderBy('questions.chapter_no', 'asc')
                ->get();

            return view('users.lecturer.questions.newQuestion')
                ->with('subjects', $subjects)
                ->with('questions', $questions)
                ->with('user', $user)
                ->with('selected', 0)//determine subj selected to insert new question 0 not
                ->with('filter', 0)
                ->with('chapter', 0);
//            ->with('subjectSelected', $subjectSelected); //determine filter or not 1 yes
        }
    }

    //create question subject dah selected
    public function createSelected(Request $request)
    {
        $subject_id = $request->subject_id;
        if($subject_id == null){
            return back()->withErrors(['errors' => 'No subject selected. Please choose a subject to proceed.']);
        }
        $user = \Auth::user();
        $subjectSelected = Subject::find($subject_id);
        $subjects = Subject::where('status' ,1)->get();
        $chapters = SubjectChapter::where('subject_id', $subjectSelected->subject_id)->get();
//        dd($chapters);
        $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
            ->where('questions.user_id', $user->id, 'AND')
            ->where('questions.status', 1)
            ->orderBy('subjects.name', 'asc')
            ->orderBy('questions.chapter_no', 'asc')
            ->get();
        return view('users.lecturer.questions.newQuestion')
            ->with('subjectSelected', $subjectSelected)
            ->with('subjects', $subjects)
            ->with('chapters', $chapters)
            ->with('questions', $questions)
            ->with('user', $user)
            ->with('selected', 1)
            ->with('filter', 0);
//            ->with('subjects', $subjects);
    }

//    public function createSelectedFilter(Request $request)
//    {
//        $subject_id = $request->subject_id;
//        if($subject_id == null){
//            return back()->withErrors(['errors' => 'No subject selected. Please choose a subject to proceed.']);
//        }
//        $user = \Auth::user();
//        $subjectSelected = Subject::find($subject_id);
//        $chapters = SubjectChapter::where('subject_id', $subjectSelected->subject_id)->get();
////        dd($chapters);
//        $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
//            ->where('questions.user_id', $user->id, 'AND')
//            ->where('questions.status', 1)
//            ->orderBy('subjects.name', 'asc')
//            ->orderBy('questions.chapter_no', 'asc')
//            ->get();
//        return view('users.lecturer.questions.newQuestion')
//            ->with('subjectSelected', $subjectSelected)
//            ->with('chapters', $chapters)
//            ->with('questions', $questions)
//            ->with('user', $user)
//            ->with('selected', 1);
////            ->with('subjects', $subjects);
//    }

    //store question data to db
    public function store(Request $request)
    {
        if($request->subject_id == null || $request->question == null || $request->answer == null || $request->chapter_no == null || $request->access_setting == null){
            return back()->withInput()->withErrors(['errors' => 'All fields are required to insert question.']);
        }
        $this->validate($request, [
            'subject_id' => 'required',
//            'diagram' => 'mimes:jpg,jpeg,png',
            'question' => 'required',
            'answer' => 'required',
            'chapter_no' => 'required',
            'access_setting' => 'required'
        ]);
        $user = \Auth::user();
        if($request->hasFile('diagram')) {
            if ($request->file('diagram')->getSize() <= 5000000) {
                $diagram = $request->file('diagram');
                $totalQuestions = Question::where('subject_id', $request->subject_id, 'AND')->where('status', 1)->count();
                $currentHighestID = Question::max('question_id');
                $next = $currentHighestID+1;
                $filename = $next . '-' . $request->subject_id . '-' . $request->chapter_no . '-' . $user->id . '-' . date('m-d-Y_hia') . '.' . $diagram->getClientOriginalExtension(); //create file name and get type
                $insertPicture = \Image::make($diagram)->save(public_path('/uploads/question_diagram/' . $filename));//insert file to folder upload
//                to resize ->resize(450, 450)
//                return $filename;
                $createQuestion = Question::create([
                    'subject_id' => $request->subject_id,
                    'user_id' => $user->id,
                    'diagram' => $filename,
                    'question' => $request->question,
                    'answer' => $request->answer,
                    'chapter_no' => $request->chapter_no,
                    'use_type' => $request->access_setting,
                    'status' => 1

                ]);
                if ($createQuestion) {
                    \Session::flash('successMessage', 'Questions successfully added.');
                    return redirect()->action('LecturerQuestionOperationController@index', $request->subject_id);
                }
                return redirect()->action('LecturerQuestionOperationController@index', $request->subject_id)->withErrors(['error' => 'Error occurred during insert process.']);
            }
            return back()->withInput()->withErrors(['errors' => 'Please choose an image less than 5Mb to proceed.']);
        }else {
//            $question_data = $request->only('subject_id', 'user_id', 'question', 'answer', 'chapter_no', 'status', 'access_setting');
            $question = Question::create([
                'subject_id' => $request->subject_id,
                'user_id' => $user->id,
                'question' => $request->question,
                'answer' => $request->answer,
                'chapter_no' => $request->chapter_no,
                'use_type' => $request->access_setting,
                'status' => 1
            ]);
            if ($question) {
                \Session::flash('successMessage', 'Questions successfully added.');
                return redirect()->action('LecturerQuestionOperationController@index', $request->subject_id);

            }
            return back()->withInput()->withErrors(['error' => 'Errors occurred during insert process.']);
        }
    }

    //lepas dah add question untuk redirect
    public function index($id)
    {
//        $subject_id = $id;
        $user = \Auth::user();
        $subjectSelected = Subject::find($id);
        $chapters = SubjectChapter::where('subject_id', $subjectSelected->subject_id)->get();
        $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
            ->where('questions.user_id', $user->id, 'AND')
            ->where('questions.status', 1)
            ->orderBy('subjects.name', 'asc')
            ->orderBy('questions.chapter_no', 'asc')
            ->get();
        return view('users.lecturer.questions.newQuestion')
            ->with('subjectSelected', $subjectSelected)
            ->with('questions', $questions)
            ->with('chapters', $chapters)
            ->with('user', $user)
            ->with('selected', 1);
//            ->with('subjects', $subjects);
    }

    //untuk view question details
    public function show($id)
    {
        $user = \Auth::user();
        $question = Question::find($id);
//        $otherQuestions = Question::where('question_id', '!=', $question->question_id, 'AND')
//            ->where('subject_id', $question->subject_id, 'AND')
//            ->where('status', 1, 'AND')
//            ->where('user_id', $user->id, )
//        $otherQuestions =
        return view('users.lecturer.questions.viewQuestion')
            ->with('question', $question)
            ->with('user', $user)
            ->with('update', 0);
    }

    public function edit($id)
    {
        $user = \Auth::user();
        $question = Question::find($id);
//        $subjects = Question::
        $chapters = SubjectChapter::where('subject_id', $question->subject->subject_id)->get();
        return view('users.lecturer.questions.editQuestion')
            ->with('question', $question)
            ->with('chapters', $chapters)
            ->with('user', $user);
//            ->with('update', 0);
    }

    public function update(Request $request, $id)
    {
        $user = \Auth::user();
        $question = Question::find($id);
        if($question->user_id == $user->id){
            $update = Question::where('question_id', $id, 'AND')->where('status', 1)->update([
//                                    'subject_id' => $request->subject,
                'question' => $request->question,
                'answer' => $request->answer,
                'chapter_no' => $request->chapter,
                'use_type' => $request->access_type
            ]);
            if($update){
                \Session::flash('successMessage', 'Question successfully updated.');
                return redirect()->action('LecturerQuestionOperationController@create');
            }
            return redirect()->action('LecturerQuestionOperationController@create')
                ->withErrors(['errors' => 'Error(s) occurred during update process. Please try again.']);
        }
        return redirect()->action('LecturerQuestionOperationController@show', $question->question_id)
            ->withErrors(['errors' => 'You are not authorized to perform this operation.']);

    }

    public function deleteQuestion($id)
    {
        $delete = Question::destroy($id);
        if($delete){
            \Session::flash('successMessage', 'Question successfully deleted.');
            return redirect()->action('LecturerQuestionOperationController@create');
        }else{
            return redirect()->action('LecturerQuestionOperationController@create')->withErrors(['errors' => 'Problem occurred during deletion process. Please try again later.']);
        }
    }
    public function destroy($id)
    {
        //
    }
}
