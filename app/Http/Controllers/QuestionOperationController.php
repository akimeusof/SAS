<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Subject;
use App\Question;

class QuestionOperationController extends Controller
{
    public function viewAllQuestions()
    {
//        $user = \Auth::user();
        $subjects = Subject::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();
        $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
//            ->where('questions.use_type', 1, 'AND') //use type 1 public 0 private
            ->where('questions.status', 1)
            ->orderBy('subjects.name', 'asc')
            ->orderBy('questions.chapter_no', 'asc')
            ->get();
        return view('users.admin.questions.viewAllQuestion')
            ->with('questions', $questions)
//            ->with('user', $user)
            ->with('subjects', $subjects)
            ->with('s_selected', 0);
    }

    public function viewAllQuestionsFiltered(Request $request)
    {
        if($request->subject_id == null){
            return redirect()->action('QuestionOperationController@viewAllQuestions')->withErrors(['errors' => 'Choose a subject to filter.']);
        }else {
            if ($request->subject_id == 0) {
                return redirect()->action('QuestionOperationController@viewAllQuestions');
            } else {
                $subjectSelected = Subject::find($request->subject_id);
                $subjects = Subject::where('status', 1)
                    ->orderBy('name', 'asc')
                    ->get();
                if ($request->chapter == 0) {
//                    $subjectSelected = Subject::find($request->subject_id);
                    $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
                        ->where('questions.subject_id', $request->subject_id, 'AND')
                        ->where('questions.status', 1)
                        ->orderBy('subjects.name', 'asc')
                        ->orderBy('questions.chapter_no', 'asc')
                        ->get();
                    return view('users.admin.questions.viewAllQuestion')
                        ->with('questions', $questions)
                        ->with('subjectSelected', $subjectSelected)
                        ->with('subjects', $subjects)
                        ->with('s_selected', 1);
                } else {
//                    $subjectSelected = Subject::find($request->subject_id);
                    $chapterSelected = $request->chapter;
                    $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
                        ->where('questions.subject_id', $request->subject_id, 'AND')
                        ->where('questions.chapter_no', $chapterSelected, 'AND')
                        ->where('questions.status', 1)
                        ->orderBy('subjects.name', 'asc')
                        ->orderBy('questions.chapter_no', 'asc')
                        ->get();
                    return view('users.admin.questions.viewAllQuestion')
                        ->with('questions', $questions)
                        ->with('subjectSelected', $subjectSelected)
                        ->with('subjects', $subjects)
                        ->with('s_selected', 1);
                }
            }
        }
    }

    public function index()
    {
        //
    }

    public function create()
    {
        $subjects = Subject::where('status', 1)->orderBy('name', 'asc')->get();
//        $questions = Question::join('subjects', 'questions.subject_id', '=', 'subjects.subject_id')
//            ->where('questions.user_id', $user->id, 'AND')
//            ->where('questions.status', 1)
//            ->orderBy('subjects.name', 'asc')
////            ->orderBy('questions.use_type', 'asc')
//            ->orderBy('questions.chapter_no', 'asc')
//            ->get();

        return view('users.lecturer.questions.newQuestion')
            ->with('subjects', $subjects)
//            ->with('questions', $questions)
//            ->with('user', $user)
            ->with('selected', 0); //for subject utk create soalan
//            ->with('filter', 0); //untuk filter questions 0 tak filter
    }

    public function store(Request $request)
    {
        //
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
