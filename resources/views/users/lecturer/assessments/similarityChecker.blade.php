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
            <div class="col-xs-6">
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"></label>
                    <div class="col-xs-9">
                        <label class ="control-label"><h3><b>Student</b></h3></label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Name:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{isset($studentSelected->user->studentprofile)?$studentSelected->user->studentprofile->name:"No Data"}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">ID:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{isset($studentSelected->user->studentprofile)?$studentSelected->user->studentprofile->id:"No Data"}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Programme:</label>
                    <div class="col-xs-9">
                        <label>
                            {{isset($studentSelected->user->studentprofile->programme)?$studentSelected->user->studentprofile->programme->name:"No Data"}}
                        </label>
                    </div>
                </div>

                {{--<div class ="form-group">--}}
                    <label class ="col-sm-2 control-label"></label>
                    <div class="col-xs-5">
                        <center><br>
                            <a href="{{ route('lecturerAssessmentOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">Back to Assessment</a><br>
                        </center>
                    </div>
                {{--</div>--}}
            </div>
            <div class="col-xs-6">
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"></label>
                    <div class="col-xs-9">
                        <label class ="control-label"><h3><b>{{$assessment->assessmentname}}</b></h3></label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Subject:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{isset($assessment->classroom->subject)?$assessment->classroom->subject->code." - ".$assessment->classroom->subject->name:""}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Section:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{isset($assessment->classroom)?$assessment->classroom->section:""}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Total Marks:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{$assessment->assessmentmarks}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">No of Questions:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{$assessment->numberofquestion}}
                        </label>
                    </div>
                </div>
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
{{--                        {!! Form::hidden('assessment_id' !!}--}}
                        {!! Form::submit('Submit', array('class' => 'btn btn-primary btn-block btn-flat')) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th width="3%"><center>NO</center></th>
                            <th width="10%"><center>ID</center></th>
                            <th>NAME</th>
                            <?php $i = 1; ?>
                            @foreach($questions as $question)
                                <th>
                                    <center>
                                        <a href="{{route('lecturerQuestionOperation.show', $question->question_id)}}" class="" >
                                            Question {{$i}}
                                        </a>
                                    </center>
                                </th>
                            <?php $i++; ?>
                            @endforeach
                            <th><center>AVERAGE</center></th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                            $x = 1;
                            $total = 0;
                            $totalSWG = 0;
                        ?>
                        @foreach($otherStudentsAttempted as $otherStudentAttempted)
                            <tr>
                                <td><center>{{$x}}</center></td>
                                <td>
                                    <center>
                                        {{isset($otherStudentAttempted->user->studentprofile)?$otherStudentAttempted->user->studentprofile->id:"No Data Found"}}</td>
                                    </center>
                                <td>
                                    <a href="{{route('l_compareTwoStudent', [$assessment->assessment_id, $studentSelected->assessmentattempt_id, $otherStudentAttempted->assessmentattempt_id])}}" class="">
                                    {{isset($otherStudentAttempted->user->studentprofile)?$otherStudentAttempted->user->studentprofile->name:"No Data Found"}}
                                    </a>
                                </td>
                                @foreach($questions as $question)
                                    <?php
                                        $s_selectedAnswer = \App\AssessmentAnswer::where('assessmentattempt_id', $studentSelected->assessmentattempt_id, 'AND')->where('assessmentquestion_id', $question->assessmentquestion_id)->first();
                                        $otherAnswer = \App\AssessmentAnswer::where('assessmentattempt_id', $otherStudentAttempted->assessmentattempt_id, 'AND')->where('assessmentquestion_id', $question->assessmentquestion_id)->first();

                                        if(isset($s_selectedAnswer->s_answer) && isset($otherAnswer->s_answer)){
                                            $compare = similar_text($s_selectedAnswer->s_answer, $otherAnswer->s_answer, $percent);
                                            $total += $percent;

                                        $compareSWG = new App\SWGCompare();
                                        $compareSWG = $compareSWG->compare($s_selectedAnswer->s_answer, $otherAnswer->s_answer);
                                        $totalSWG += $compareSWG;
                                    ?>
                                        <td>
                                            <center>
                                                {{number_format($compareSWG*100, 2)." %"}}
                                            </center>
                                        </td>
                                    <?php }
                                        else {
                                            ?>
                                            <td colspan="2">
                                                No Data Found
                                            </td>
                                    <?php } ?>
                                @endforeach
                                <td>
                                    <center>
                                        {{number_format($totalSWG*100/$questions->count(), 2). " %"}}
                                    </center>
                                </td>
                                <?php $total = 0 ; $totalSWG = 0;?>
                            </tr>
                            <?php $x++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        {{--@endif--}}


    </div>
{{--first div--}}
@stop()
