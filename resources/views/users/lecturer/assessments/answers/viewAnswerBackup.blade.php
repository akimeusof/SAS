@extends('layout.layoutSubLecturer')
@section('content')
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        @if(count($errors))
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(\Session::has('successMessage'))

            <div class="alert alert-success alert-dismissable">
                <span class="glyphicon glyphicon-ok"></span>
                <button type="button" class="close" data-dismiss="alert" aris-hidden="true">&times;</button>
                <em> {!! session('successMessage') !!}</em>
            </div>
        @endif


        <div class="box-body">
            <div class="col-xs-3">
                <div class ="form-group">
                    <label class ="col-sm-1 control-label"></label>
                    <div class="col-xs-10">
                        <label class ="control-label"><h1><b>Operations</b></h1></label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="control-label"></label>
                    <div class="col-xs-10">
                        <a href="{{ route('l_viewAllAssessment') }}" class="btn btn-default btn-block btn-flat">List of Assessments</a><br>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="control-label"></label>
                    <div class="col-xs-10">
                        <a class="btn btn-default btn-block btn-flat" href="{{ route('l_newAssessment') }}">Create New Assessment</a><br>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="control-label"></label>
                    <div class="col-xs-10">
                        <a href="{{ route('lecturerAssessmentOperation.edit', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">Edit Assessment's Details</a><br>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="control-label"></label>
                    <div class="col-xs-10">
                        <a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">Manage Assessment's Questions</a><br>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="control-label"></label>
                    <div class="col-xs-10">
                        <a href="{{ route('lecturerClassroomOperation.show', $assessment->classroom_id) }}" class="btn btn-default btn-block btn-flat">View Class Details</a><br>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="control-label"></label>
                    <div class="col-xs-10">
                        <a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">View Students Yang dah Attempt</a><br>
                    </div>
                </div>
            </div>

            <div class="col-xs-5">
                {!! Form::open(array('class' => 'form-horizontal')) !!}
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"></label>
                    <div class="col-xs-6">
                        <label class ="control-label"><h1>Assessment: <b><u>{{$assessment->assessmentname}}</u></b></h1></label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"><h4>Subject:</h4></label>
                    <div class="col-xs-6">
                        <label class ="control-label">
                            <h4><b>
                                    {{isset($assessment->classroom->subject)?$assessment->classroom->subject->code." - ".$assessment->classroom->subject->name:""}}
                                </b></h4>
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"><h4>Section:</h4></label>
                    <div class="col-xs-6">
                        <label class ="control-label">
                            <h4><b>
                                    {{isset($assessment->classroom)?$assessment->classroom->section:""}}
                                </b></h4>
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"><h4>Marks:</h4></label>
                    <div class="col-xs-6">
                        <label class ="control-label">
                            <h4><b>
                                    {{$assessment->assessmentmarks." %"}}
                                </b></h4>
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"><h4>Number of Questions:</h4></label>
                    <div class="col-xs-6">
                        <label class ="control-label">
                            <h4><b>
                                    {{$assessment->numberofquestion}}
                                </b></h4>
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"><h4>Time Limit:</h4></label>
                    <div class="col-xs-6">
                        <label class ="control-label">
                            <h4><b>
                                    {{$assessment->duration." minutes"}}
                                </b></h4>
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"><h4>Date Attempt:</h4></label>
                    <div class="col-xs-6">
                        <label class ="control-label">
                            <h4><b>
                                    {{$studentAttempted->created_at}}
                                </b></h4>
                        </label>
                    </div>
                </div>
                <br>

                {!! Form::close() !!}
            </div>
            <div class="col-xs-4">
                {!! Form::open(array('class' => 'form-horizontal')) !!}
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"></label>
                    <div class="col-xs-6">
                        <label class ="control-label"><h1><b>Student</b></h1></label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"><h4>Subject:</h4></label>
                    <div class="col-xs-6">
                        <label class ="control-label">
                            <h4><b>
                                    {{isset($assessment->classroom->subject)?$assessment->classroom->subject->code." - ".$assessment->classroom->subject->name:""}}
                                </b></h4>
                        </label>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

        {{--        @if($studentsAttempted != null)--}}
        <div class="box">
        <?php $x = 1; ?>
        <!-- Table row -->
            {{--<div class="row">--}}
            @foreach($assessmentAnswers as $assessmentAnswer)
                <div class="box box-solid box-default">
                    <div class="box-header with-border">
                        <div class="col-xs-10">
                            <h3 class="box-title">Question {{$x}}</h3>
                            <div class="box-tools pull-right">
                                <!-- Buttons, labels, and many other things can be placed here! -->
                                <!-- Here is a label for example -->
                                {{--<span class="label label-primary">Label</span>--}}
                            </div><!-- /.box-tools -->
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-xs-2">
                            <h4>OPERATIONS:</h4>
                        </div>
                        <div class="col-xs-8">
                            {!! nl2br(e($assessmentAnswer->question->question)) !!}
                            gambar
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-xs-2">
                            <?php
                            if(isset($assessmentAnswer->question->answer) && isset($assessmentAnswer->s_answer)){
                                $convertReal = htmlspecialchars($assessmentAnswer->question->answer);
                                $convertRealEntity = htmlentities($assessmentAnswer->question->answer);
                                $convertSelected =  htmlspecialchars($assessmentAnswer->s_answer);
                                $convertSelectedEntity =  htmlentities($assessmentAnswer->s_answer);
//                                        $compareRemoveSpace = new App\CompareAnswer($convertReal, $convertSelected,
//                                                array('remove_html_tags'=>false, 'remove_extra_spaces'=>true)
//                                        );
//                                        $compareWithSpace = new App\CompareAnswer($convertReal, $convertSelected,
//                                                array('remove_html_tags'=>false)
//                                        );
//                                        $resultRemoveSpace = $compareRemoveSpace->getSimilarityPercentage();
//                                        $resultWithSpace = $compareWithSpace->getSimilarityPercentage();
                                $compare = similar_text($assessmentAnswer->question->answer, $assessmentAnswer->s_answer, $percent);
//                                        $compare2 = similar_text($convertReal, $convertSelected, $percent2);
//                                        $compare3 = similar_text($convertRealEntity, $convertSelectedEntity, $percent3);
                                $compareSWGNormal = new App\SWGCompare();
                                $compareSWGNormal = $compareSWGNormal->compare($assessmentAnswer->question->answer, $assessmentAnswer->s_answer);
//                                        $compareSWGSP = new App\SWGCompare();
//                                        $compareSWGSP = $compareSWGSP->compare($convertReal, $convertSelected);
//                                        $compareSWGHE = new App\SWGCompare();
//                                        $compareSWGHE = $compareSWGHE->compare($convertRealEntity, $convertSelectedEntity);
                            }
                            ?>
                            <h3>Similarity Checker: <b>{{number_format($percent, 2)." %"}}</b></h3><br>
                            {{--<h3>Similarity Index: <b>{{number_format($resultRemoveSpace, 2)." % Remove Space ".number_format($resultWithSpace, 2)." % With Space"}}</b></h3><br>--}}
                            {{--<h3>--}}
                            {{--@if($resultWithSpace > $percent)--}}
                            {{--Test : {{number_format($resultWithSpace, 2)}}--}}
                            {{--@endif--}}
                            {{--</h3>--}}
                            {{--<h3>--}}
                            {{--Similarity Checker (with htmlspecialchar: <b>{{number_format($percent2, 2)." %"}}</b><br>--}}
                            {{--</h3>--}}
                            {{--<h3>--}}
                            {{--Similarity Check HtmlEntities: <b>{{number_format($percent3, 2)." %"}}</b>--}}
                            {{--</h3>--}}
                            <h3>
                                Similarity Check SWG: <b>{{number_format($compareSWGNormal*100, 2)." %"}}</b>
                            </h3>
                            {{--<h3>--}}
                            {{--Similarity Check SWG SP: <b>{{$compareSWGSP}}</b>--}}
                            {{--</h3>--}}
                            {{--<h3>--}}
                            {{--Similarity Check SWG HE: <b>{{$compareSWGHE}}</b>--}}
                            {{--</h3>--}}
                            <h3>
                                <?php
                                //                                        $a_anwer = App\AssessmentAnswer::find($assessmentAnswer->assessmentanswer_id);
                                //                                            $question = App\Question::find(9);
                                //                                        $client= "dedf6d1ccdd21884aa2316e28e3ca7d95761e49b";
                                ////                                        $code = $a_anwer->s_answer;
                                //                                            $code = $question->answer;
                                //                                        $lang = "PHP";
                                //                                        $input = "";
                                //
                                //                                        $hack = new App\HackApi();
                                //                                        $hack->set_client_secret($client);
                                //                                        $hack->init($lang, $code, $input);
                                //                                        $hack->compile();
                                //                                        echo $hack = $hack->compile_status;
                                //                                        if($hack == "OK"){
                                //                                            echo "Compile Status: Success";
                                //                                        }
                                //                                        else{
                                //                                            echo "Compile Status: Fail";
                                //                                        }
                                //                                        ?>
                            </h3>

                        </div>
                        <div class="col-xs-8">
                            {!! Form::open(array('class' => 'form-horizontal', 'route' => 'l_toCompare')) !!}
                            <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-top: medium solid #000000;border-right: medium solid #000000;border-left: medium solid #000000;border-bottom: medium solid #000000">
                                <tr >
                                    <td width="50%" align="center" bgcolor="#ccddff">
                                        <font face="verdana" size="3" ><b>Expected Answer</b></font>
                                        {{--<input type="file" name="mainFile"/>--}}
                                    </td>
                                    <td width="50%" align="center" bgcolor="#ffccdd">
                                        <font face="verdana" size="3" ><b>Student's Answer</b></font>
                                        {{--<input type="file" name="fileToCompare"/>--}}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" align="center">
                                        <br/>
                                        <input type="hidden" name="q_id" value="{{$assessmentAnswer->question->question_id}}">
                                        <input type="hidden" name="aa_id" value="{{$assessmentAnswer->assessmentanswer_id}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" value="Start Comparison" name="submitButton" onclick="return onSubmit()"/>
                                        <br/>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                        <br />
                                    </td>
                                </tr>
                                <tr>
                                    <td>{!! isset($assessmentAnswer->question)?nl2br(e($assessmentAnswer->question->answer)):"asd" !!}</td>
                                    <td>{!! isset($assessmentAnswer)?nl2br(e($assessmentAnswer->s_answer)):"" !!}</td>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                        <br />
                                    </td>
                                </tr>
                            </table>
                            {!! Form::close() !!}

                        </div>
                    </div><!-- box-footer -->
                </div><!-- /.box -->
                <?php $x++; ?>
            @endforeach
            {{--</div>--}}
        </div>
        {{--@endif--}}


    </div>
{{--first div--}}
@stop()
