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
            {{--<div class="col-xs-3">--}}
                {{--<div class ="form-group">--}}
                    {{--<label class ="col-sm-1 control-label"></label>--}}
                    {{--<div class="col-xs-10">--}}
                        {{--<label class ="control-label"><h1><b>Operations</b></h1></label>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class ="form-group">--}}
                    {{--<label class ="control-label"></label>--}}
                    {{--<div class="col-xs-10">--}}
                        {{--<a href="{{ route('l_viewAllAssessment') }}" class="btn btn-default btn-block btn-flat">List of Assessments</a><br>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class ="form-group">--}}
                    {{--<label class ="control-label"></label>--}}
                    {{--<div class="col-xs-10">--}}
                        {{--<a class="btn btn-default btn-block btn-flat" href="{{ route('l_newAssessment') }}">Create New Assessment</a><br>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class ="form-group">--}}
                    {{--<label class ="control-label"></label>--}}
                    {{--<div class="col-xs-10">--}}
                        {{--<a href="{{ route('lecturerAssessmentOperation.edit', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">Edit Assessment's Details</a><br>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class ="form-group">--}}
                    {{--<label class ="control-label"></label>--}}
                    {{--<div class="col-xs-10">--}}
                        {{--<a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">Manage Assessment's Questions</a><br>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class ="form-group">--}}
                    {{--<label class ="control-label"></label>--}}
                    {{--<div class="col-xs-10">--}}
                        {{--<a href="{{ route('lecturerClassroomOperation.show', $assessment->classroom_id) }}" class="btn btn-default btn-block btn-flat">View Class Details</a><br>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class ="form-group">--}}
                    {{--<label class ="control-label"></label>--}}
                    {{--<div class="col-xs-10">--}}
                        {{--<a href="{{ route('l_AssessmentQuestionOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-block btn-flat">View Students Yang dah Attempt</a><br>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

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
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Time Limit:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{$assessment->duration." minutes"}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label"><h4></h4></label>
                    <div class="col-xs-3">
                        <label class ="control-label">
                            <a href="{{ route('lecturerAssessmentOperation.show', $assessment->assessment_id) }}" class="btn btn-default btn-lg btn-block btn-flat">Cancel/Back</a><br>
                        </label><br>
                        Back To Assessment
                    </div>
                    <div class="col-xs-3">
                        <label class ="control-label">
                            {!! Form::hidden('assessmentattempt_id', $studentAttempted->assessmentattempt_id)  !!}
                            {!! Form::submit('Submit Marks', array('class' => 'btn btn-success btn-block btn-lg')) !!}<br>
                        </label>
                        Leave if no changes made to the Marks

                    </div>
                </div>

            </div>
            <div class="col-xs-6">
{{--                {!! Form::open(array('class' => 'form-horizontal')) !!}--}}
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
                            {{isset($studentAttempted->user->studentprofile)?$studentAttempted->user->studentprofile->name:"No Data"}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">ID:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{isset($studentAttempted->user->studentprofile)?$studentAttempted->user->studentprofile->id:"No Data"}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Programme:</label>
                    <div class="col-xs-9">
                        <label class="control-label">
                            {{isset($studentAttempted->user->studentprofile->programme)?$studentAttempted->user->studentprofile->programme->name:"No Data"}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Date Attempt:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            {{$studentAttempted->created_at}}
                        </label>
                    </div>
                </div>
                <div class ="form-group">
                    <label class ="col-sm-3 control-label">Marks Scored:</label>
                    <div class="col-xs-9">
                        <label class ="control-label">
                            <?php
                                $sumMarks = $assessmentAnswers->sum('marks');
                                echo $sumMarks." / ".$assessment->assessmentmarks;
                            ?>
                        </label>
                    </div>
                </div>
                {{--{!! Form::close() !!}--}}
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
                                    <?php
                                        $compare = new App\SWGCompare();
                                        $compare = $compare->compare($assessmentAnswer->assessmentquestion->question->answer, $assessmentAnswer->s_answer);
                                    ?>
                                    <h4>Similarity: {{number_format($compare*100, 2)." %"}}</h4>
                                    <h4>Marks Generated: {{$assessmentAnswer->marks." / ".$assessmentAnswer->assessmentquestion->marks}}</h4>
                                </div>
                                <div class="col-xs-7">
                                    {!! nl2br(e($assessmentAnswer->assessmentquestion->question->question)) !!}<br>
                                    @if($assessmentAnswer->assessmentquestion->question->diagram != null)
                                        {{--<a href="">--}}
                                            <img src="/uploads/question_diagram/{{$assessmentAnswer->assessmentquestion->question->diagram}}" class="center-block user-image" title=" " style="width:400px; height:400px">
                                        {{--</a>--}}
                                    @endif
                                </div>
                                <div class="col-xs-3">
                                </div>
                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <div class="col-xs-2">
                                    Edit Marks: (Leave if no change)<br>
                                    {!! Form::hidden('assessmentquestion_id[]', $assessmentAnswer->assessmentquestion_id) !!}
                                    {!! Form::number('marks[]', $assessmentAnswer->marks, array('class' => 'form-control', 'min' => 0, 'max' => $assessmentAnswer->assessmentquestion->marks)) !!}
                                </div>
                                <div class="col-xs-10">
{{--                                    {!! Form::open(array('class' => 'form-horizontal')) !!}--}}
                                        <table border="0" width="100%" cellspacing="0" cellpadding="0" style="border-top: medium solid #000000;border-right: medium solid #000000;border-left: medium solid #000000;border-bottom: medium solid #000000">
                                            <tr >
                                                <td width="50%" align="center" bgcolor="#ccddff">
                                                    <font face="verdana" size="3" ><b>Expected Answer</b></font>
                                                </td>
                                                <td width="50%" align="center" bgcolor="#ffccdd">
                                                    <font face="verdana" size="3" ><b>Student's Answer</b></font>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan='2'>
                                                    <br />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{!! isset($assessmentAnswer->assessmentquestion->question)?nl2br(e($assessmentAnswer->assessmentquestion->question->answer)):"No Data" !!}</td>
                                                <td>{!! isset($assessmentAnswer)?nl2br(e($assessmentAnswer->s_answer)):"" !!}</td>
                                            </tr>
                                            <tr>
                                                <td colspan='2'>
                                                    <br />
                                                </td>
                                            </tr>
                                        </table>
{{--                                    {!! Form::close() !!}--}}

                                </div>
                                {{--<div class="col-xs-3">--}}
{{--                                    {!! Form::number('marks_sm', $assessmentAnswer->marks_sm, array('class' => 'form-control')) !!}<br>--}}
                                {{--</div>--}}
                            </div><!-- box-footer -->
                        </div><!-- /.box -->
                        <?php $x++; ?>
                    @endforeach
                {{--</div>--}}
            </div>
            {{--@endif--}}
        {!! Form::close() !!}
    </div>
{{--first div--}}
@stop()
