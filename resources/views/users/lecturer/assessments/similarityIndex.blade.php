@extends('layout.layoutSubLecturer')
@section('content')
</section>

<!-- Main content -->
<section class="content">
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
    <!-- Default box -->
    <div class="box">
        <div class="box-body">
            <div class="col-xs-3">
                <div class ="form-group">
                    <label class ="control-label"></label>
                    <div class="col-xs-10">
                        <label class ="control-label"><h1><b>Menu</b></h1></label>
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
                    <div class="col-xs-5">
                        <a href="{{ route('l_editAssessmentOpenDate', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">Edit Start Date</a><br>
                    </div>
                    <div class="col-xs-5">
                        <a href="{{ route('l_editAssessmentCloseDate', $assessment->assessment_id)}}" class="btn btn-default btn-block btn-flat">Edit End Date</a><br>
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
                {{--<div class ="form-group">--}}
                    {{--<label class ="control-label"></label>--}}
                    {{--<div class="col-xs-10">--}}
                        {{--<a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">View Students Yang dah Attempt</a><br>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>

            <div class="col-xs-9">
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
                    <label class ="col-sm-3 control-label"><h4>Open:</h4></label>
                    <div class="col-xs-6">
                        <label class ="control-label">
                            <h4><b>
                                    {{$assessment->start}}
                                </b></h4>
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"><h4>Close:</h4></label>
                    <div class="col-xs-6">
                        <label class ="control-label">
                            <h4><b>
                                    {{$assessment->end}}
                                </b></h4>
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"></label>
                    <div class="col-xs-4">
                        <label class ="control-label">
                            <a href="{{route('lecturerAssessmentOperation.show', $assessment->assessment_id)}}" class="btn btn-default btn-lg btn-block">Back to Assessment</a>
                        </label>
                    </div>
                </div>
                <br>

                {!! Form::close() !!}
            </div>
        </div>

        {{--        @if($studentsAttempted != null)--}}
        <div class="box">
            <div class="box-header">
                {!! Form::open(array(
                  'class' => 'form-horizontal',
                  'route' => 'l_viewSimilarity')) !!}
                <div class="col-xs-1">
                    <label class ="col-sm-1 control-label">
                        <h4 class="box-title"><b>Student:</b></h4>
                    </label>
                </div>
                <div class="col-xs-3">
                    <select name="assessmentattempt_id" class="form-control">
                                <option value="{{$studentSelected->assessmentattempt_id}}">
                                    {{$studentSelected->user->studentprofile->id." - ".$studentSelected->user->studentprofile->name}}
                                </option>
                                @foreach($otherStudentsAttempted as $otherStudentAttempted)
                                    <option value="{{$otherStudentAttempted->assessmentattempt_id}}">
                                        {{$otherStudentAttempted->user->studentprofile->id." - ".$otherStudentAttempted->user->studentprofile->name}}
                                    </option>
                                @endforeach
                            </select>
                </div>
                <div class="col-xs-1">
                    {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
                </div>
                {!! Form::close() !!}
            </div>
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="3%">NO</th>
                    <th width="10%">ID</th>
                    <th>NAME</th>
                    <?php $i = 1; ?>
                    @foreach($questions as $question)
                        <th><a href="{{route('lecturerQuestionOperation.show', $question->question_id)}}" class="">Q {{$i. " - ". $question->question_id}}</a></th>
                        <?php $i++; ?>
                    @endforeach
                    <th>Average</th>

                </tr>
                </thead>
                <tbody>
                <?php
                $x = 1;
                $total = 0;
                ?>
                @foreach($otherStudentsAttempted as $otherStudentAttempted)
                    <tr>
                        <td>{{$x}}</td>
                        <td><a href="{{route('l_viewSimilarity.index', $otherStudentAttempted->assessmentattempt_id)}}">{{isset($otherStudentAttempted->user->studentprofile)?$otherStudentAttempted->user->studentprofile->id:"No Data Found"}}</a></td>
                        <td>{{isset($otherStudentAttempted->user->studentprofile)?$otherStudentAttempted->user->studentprofile->name:"No Data Found"}}</td>
                        @foreach($questions as $question)
                            <?php
                                $s_selectedAnswer = \App\AssessmentAnswer::where('assessmentattempt_id', $studentSelected->assessmentattempt_id, 'AND')->where('question_id', $question->question_id)->first();
                                $otherAnswer = \App\AssessmentAnswer::where('assessmentattempt_id', $otherStudentAttempted->assessmentattempt_id, 'AND')->where('question_id', $question->question_id)->first();
                                if(isset($s_selectedAnswer->s_answer) && isset($otherAnswer->s_answer)){
                                    $convertSelected =  htmlspecialchars($s_selectedAnswer->s_answer);
                                    $convertOther = htmlspecialchars($otherAnswer->s_answer);
                                    //                            $compare = similar_text($s_selectedAnswer->s_answer, $otherAnswer->s_answer, $percent);
                                    $compare = new App\CompareAnswer($convertSelected, $convertOther,
                                            array('remove_html_tags'=>false, 'remove_extra_spaces'=>true)
                                    );
                                    $result = $compare->getSimilarityPercentage();
                                    $total += $result;
                            ?>
                            <td>
                                {{number_format($result, 2)." %"}}
                                {{--echo $string1.' and '.$string2 are '.$percent.'% similar and '.$percent2.'% differnt';--}}
                            </td>
                            <?php }
                            else {
                            ?>
                            <td>
                                No Data
                            </td>
                            <?php } ?>
                        @endforeach
                        <td>{{$total/count($questions)}}</td>
                    </tr>
                    <?php $x++; ?>
                @endforeach
                </tbody>
            </table>
        </div>
        {{--@endif--}}

        </div>

    </div>
{{--first div--}}
@stop()
