<?php

namespace App\Http\Controllers;
//namespace App;
use App\Assessment;
use App\AssessmentAnswer;
use App\AssessmentQuestion;
use App\Diff;
use App\Question;
use Illuminate\Database\Eloquent\QueueEntityResolver;
use Illuminate\Http\Request;
use App\ToCompare;
use App\HackApi;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\AssessmentAttempt;
use App\User;
use App\FineDiff;

class LecturerViewStudentAnswerOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = Question::find(5);
        $answer = AssessmentAnswer::find(5);
        $client= "dedf6d1ccdd21884aa2316e28e3ca7d95761e49b";
        $code = $question->answer;
        $lang = "PHP";
        $input = "";

        $hack = new HackApi();
        $hack->set_client_secret($client);
        $hack->init($lang, $code, $input);
        $hack->compile();
        $hack->run();
//        echo $hack->run('output');

        dd( $hack = $hack->output_html);
//        if($hack == "OK"){
//            return "confirm okay";
//        }
//        return "barai";

//        return view('users.lecturer.assessments.example2')->with('granularity', 0);
    }
    
    public function toCompare(Request $request)
    {
//        dd($request->all());
        $compareFiles = new ToCompare();
//        $question = Question::find(3);
//        $s_ans = AssessmentAnswer::find(3);
        $s_ans = AssessmentAnswer::find($request->aa_id);
        $question = Question::find($request->q_id);
//        dd($s_ans);


        // File paths of the two files
//        $file1 = $_FILES['mainFile']['tmp_name'];
//        $file2 = $_FILES['fileToCompare']['tmp_name'];


//
//        $file1Contents = file($file1);
//        $file2Contents = file($file2);

        $compareFiles->compareFiles($request->aa_id,$request->q_id);
        return view('users.lecturer.assessments.example2')->with('compareFiles', $compareFiles);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }


    //show page assessment with student yg selected utk view answer dia
    public function show($id)
    {
        $studentAttempted = AssessmentAttempt::find($id);
        $user = User::find($studentAttempted->user->id);
        $assessment = Assessment::find($studentAttempted->assessment->assessment_id);
        $assessmentAnswers = AssessmentAnswer::where('assessmentattempt_id', $studentAttempted->assessmentattempt_id)->get();
        return view('users.lecturer.assessments.answers.viewStudentAnswer')
            ->with('user', $user)
            ->with('studentAttempted', $studentAttempted)
            ->with('assessment', $assessment)
            ->with('assessmentAnswers', $assessmentAnswers);
    }

    public function editStudentAssessmentMarks(Request $request)
    {
        $assessmentquestion_id = $request->assessmentquestion_id;
        $marks = $request->marks;
        $assessmentAttempt = AssessmentAttempt::find($request->assessmentattempt_id);
        for($i = 0; $i < count($assessmentquestion_id); $i++){
            $answer = AssessmentAnswer::where('assessmentattempt_id', $assessmentAttempt->assessmentattempt_id, 'AND')
                ->where('assessmentquestion_id', $assessmentquestion_id[$i])->first();
            $updateMarks = $answer->update(['marks' => $marks[$i]]);
        }
        if($updateMarks){
            \Session::flash('successMessage', 'Marks successfully updated.');
            return redirect()->action('LecturerViewStudentAnswerOperationController@show', $assessmentAttempt->assessmentattempt_id);
        }
        return redirect()->action('LecturerViewStudentAnswerOperationController@show', $assessmentAttempt->assessmentattempt_id)
            ->withErrors(['errors' => 'Problem occurred during update process. Please try again later.']);
    }
    
    public function compareTwoStudent($a_id, $f_s_id, $s_s_id)
    {
        $assessment = Assessment::find($a_id);
        $chosenStudent = AssessmentAttempt::find($f_s_id);
        $compareTo = AssessmentAttempt::find($s_s_id);
        $chosenStudentAnswers = AssessmentAnswer::where('assessmentattempt_id', $chosenStudent->assessmentattempt_id)->get();
        return view('users.lecturer.assessments.answers.compareTwoStudent')
            ->with('assessment', $assessment)
            ->with('chosenStudent', $chosenStudent)
            ->with('compareTo', $compareTo)
            ->with('chosenStudentAnswers', $chosenStudentAnswers);
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
