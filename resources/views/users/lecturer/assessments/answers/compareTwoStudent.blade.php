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
            {{--start--}}
            {!! Form::open(array('class' => 'form-horizontal', 'route' => 'l_editStudentAssessmentMarks')) !!}
            <div class="col-xs-4">
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
                <label class ="col-sm-2 control-label"></label>
                <div class="col-xs-5">
                    <center>
                        <a href="{{ route('lecturerAssessmentOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">Back to Assessment</a><br>
                    </center>
                </div>
            </div>
            <div class="col-xs-4">
                {{--                {!! Form::open(array('class' => 'form-horizontal')) !!}--}}
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"></label>
                    <div class="col-xs-9">
                        <label class ="control-label"><h3><b>Student 1</b></h3></label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Name:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{isset($chosenStudent->user->studentprofile)?$chosenStudent->user->studentprofile->name:"No Data"}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">ID:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{isset($chosenStudent->user->studentprofile)?$chosenStudent->user->studentprofile->id:"No Data"}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Programme:</label>
                    <div class="col-xs-9">
                        <label class="">
                            {{isset($chosenStudent->user->studentprofile->programme)?$chosenStudent->user->studentprofile->programme->name:"No Data"}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Date Attempt:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{$chosenStudent->created_at}}
                        </label>
                    </div>
                </div>
                {{--{!! Form::close() !!}--}}
            </div>
            <div class="col-xs-4">
                {{--                {!! Form::open(array('class' => 'form-horizontal')) !!}--}}
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"></label>
                    <div class="col-xs-9">
                        <label class ="control-label"><h3><b>Student 2</b></h3></label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Name:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{isset($compareTo->user->studentprofile)?$compareTo->user->studentprofile->name:"No Data"}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">ID:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{isset($compareTo->user->studentprofile)?$compareTo->user->studentprofile->id:"No Data"}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Programme:</label>
                    <div class="col-xs-9">
                        <label class="">
                            {{isset($compareTo->user->studentprofile->programme)?$compareTo->user->studentprofile->programme->name:"No Data"}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Date Attempt:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{$compareTo->created_at}}
                        </label>
                    </div>
                </div>
                {{--{!! Form::close() !!}--}}
            </div>
        </div>
        {{--        @if($studentsAttempted != null)--}}
        <div class="box">
        <?php
            $x = 1;
            $similarity_array = array();
        ?>
            @foreach($chosenStudentAnswers as $chosenStudentAnswer)
                <div class="box box-solid box-default">
                    <div class="box-header with-border">
                        <div class="col-xs-10">
                            <h3 class="box-title">Question {{$x}}</h3>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-2">
                            <?php
                                $student1_ans = $chosenStudentAnswer->s_answer;
                                $student2_ans = App\AssessmentAnswer::where('assessmentquestion_id', $chosenStudentAnswer->assessmentquestion_id, 'AND')
                                        ->where('assessmentattempt_id', $compareTo->assessmentattempt_id)->first();
                                $s_2_ans = $student2_ans->s_answer;
                            $compare = new App\SWGCompare();
                            $compare = $compare->compare($student1_ans, $s_2_ans);
                            $similarity = number_format($compare*100, 2);
                            ?>
                            <h4>Similarity: {{$similarity." %"}}</h4>
                                <?php $similarity_array[] = $similarity?>
{{--                            <h4>Marks Generated: {{$assessmentAnswer->marks." / ".$assessmentAnswer->assessmentquestion->marks}}</h4>--}}
                        </div>
                        <div class="col-xs-7">
                            {!! nl2br(e($chosenStudentAnswer->assessmentquestion->question->question)) !!}<br>
                            @if($chosenStudentAnswer->assessmentquestion->question->diagram != null)
                                {{--<a href="">--}}
                                <img src="/uploads/question_diagram/{{$chosenStudentAnswer->assessmentquestion->question->diagram}}" class="center-block user-image" title=" " style="width:400px; height:400px">
                                {{--</a>--}}
                            @endif
                        </div>
                        <div class="col-xs-3">
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="col-xs-2">
                            {{--Edit Marks: (Leave if no change)<br>--}}
                            {{--{!! Form::hidden('assessmentquestion_id[]', $assessmentAnswer->assessmentquestion_id) !!}--}}
                            {{--{!! Form::number('marks[]', $assessmentAnswer->marks, array('class' => 'form-control', 'min' => 0, 'max' => $assessmentAnswer->assessmentquestion->marks)) !!}--}}
                        </div>
                        <div class="col-xs-10">
                            {!! Form::open(array('class' => 'form-horizontal')) !!}
                            <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-top: medium solid #000000;border-right: medium solid #000000;border-left: medium solid #000000;border-bottom: medium solid #000000">
                                <tr >
                                    <td width="50%" align="center" bgcolor="#ccddff">
                                        <font face="verdana" size="3" ><b>Student 1 Answer</b></font>
                                    </td>
                                    <td width="50%" align="center" bgcolor="#ffccdd">
                                        <font face="verdana" size="3" ><b>Student 2 Answer</b></font>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                        <br />
                                    </td>
                                </tr>
                                <tr>
                                    <td>{!! nl2br(e($student1_ans)) !!}</td>
                                    <td>{!! nl2br(e($s_2_ans)) !!}</td>
                                </tr>
                                <tr>
                                    <td colspan='2'>
                                        <br />
                                    </td>
                                </tr>
                            </table>
                            {!! Form::close() !!}
                        </div>
                        {{--<div class="col-xs-3">--}}
                        {{--                                    {!! Form::number('marks_sm', $assessmentAnswer->marks_sm, array('class' => 'form-control')) !!}<br>--}}
                        {{--</div>--}}
                    </div>
                </div><!-- /.box -->
                <?php $x++; ?>
            @endforeach
            <div class="box box-solid box-success">
                <div class="box-header with-border">
                    <div class="col-xs-10">
                        <h3 class="box-title">Average Similarity: {{number_format(array_sum($similarity_array)/$chosenStudentAnswers->count(), 2)." %"}}</h3>
                    </div>
                </div><!-- box-footer -->
            </div>
        </div>
        {{--@endif--}}
        {!! Form::close() !!}
    </div>
{{--first div--}}
@stop()
