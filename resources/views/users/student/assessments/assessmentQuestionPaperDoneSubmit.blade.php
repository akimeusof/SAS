@extends('layout.layoutSubStudent')
@section('content')
</section>
<!-- Main content -->
<section class="invoice">
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
{!! Form::open(array(
     'class' => 'form-horizontal')) !!}
<!-- title row -->
    <div class="row">
        <div class="col-xs-12">
            <h2 class="page-header">
                <i class="fa fa-globe"></i>
                {{isset($assessmentAttemptData->assessment->classroom->subject)
                    ?strtoupper($assessmentAttemptData->assessment->classroom->subject->code." - ".$assessmentAttemptData->assessment->classroom->subject->name)
                    :"No Data Found"}}

                <small class="pull-right">Date Attempt: {{$assessmentAttemptData->created_at}}</small>
            </h2>
        </div>
        <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
        <div class="col-sm-2 invoice-col">
            <address>
                Name: <br>
                Matric ID: <br>
                Programme: <br>
                E - Mail: <br>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <address>
                <strong>{{isset($assessmentAttemptData->user->studentprofile)?$assessmentAttemptData->user->studentprofile->name:"No Data"}}</strong><br>
                <strong>{{isset($assessmentAttemptData->user->studentprofile)?$assessmentAttemptData->user->studentprofile->id:"No Data"}}</strong><br>
                <strong>{{isset($assessmentAttemptData->user->studentprofile)?$assessmentAttemptData->user->studentprofile->programme->name:"No Data"}}</strong><br>
                <strong>{{isset($assessmentAttemptData->user->studentprofile)?$assessmentAttemptData->user->studentprofile->email:"No Data"}}</strong><br>
            </address>
        </div>
        <div class="col-sm-2 invoice-col">
            <address>
                Assessment: <br>
                Total Marks: <br>
                Total Questions: <br>
                Marks Scored: <br>
            </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
            <address>
                <strong>{{isset($assessmentAttemptData->assessment)?$assessmentAttemptData->assessment->assessmentname:"No Data"}}</strong><br>
                <strong>{{isset($assessmentAttemptData->assessment)?$assessmentAttemptData->assessment->assessmentmarks:"No Data"}}</strong><br>
                <strong>{{isset($assessmentAttemptData->assessment)?$assessmentAttemptData->assessment->numberofquestion:"No Data"}}</strong><br>
                {{--<strong>{{isset($assessmentAttemptData->assessment)?$assessmentAttemptData->assessment->duration:"No Data"}}</strong><br>--}}
                <strong>
                    @if($assessmentAttemptData->assessment->revealmarks == 0)
                        Not Available
                    @else
                        <?php
                            $getMarks = App\AssessmentAnswer::where('assessmentattempt_id', $assessmentAttemptData->assessmentattempt_id)->get();
                            $sumMarks = $getMarks->sum('marks');
                        ?>
                        {{$sumMarks." / ".$assessmentAttemptData->assessment->assessmentmarks}}
                    @endif

                </strong><br>
            </address>
        </div>
    </div>
    <!-- /.row -->
@if($answers->count() >= 1)
<?php $x = 1; ?>
<!-- Table row -->
    <div class="row">
        @foreach($answers as $answer)
            <div class="box box-solid box-default">
                <div class="box-header with-border">
                    <div class="col-xs-7">
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
                        <h4>Question:</h4>
                    </div>
                    <div class="col-xs-6">
                        {!! nl2br(e($answer->assessmentquestion->question->question)) !!}<br>
                        @if(isset($answer->assessmentquestion->question)?$answer->assessmentquestion->question->diagram:"" != null)
                            <img src="/uploads/question_diagram/{{$answer->assessmentquestion->question->diagram}}" class="center-block user-image" title="" style="width:400px; height:400px">
                        @endif
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="col-xs-2">
                        <h4>Answer:</h4>
                    </div>
                    <div class="col-xs-6">

                        {!! nl2br(e($answer->s_answer)) !!}
                    </div>
                </div><!-- box-footer -->
            </div><!-- /.box -->
            <?php $x++; ?>
        @endforeach
        <label class="col-sm-4"></label>
        <div class="col-xs-4">
            {{--{!! Form::hidden('assessmentattempt_id', $attempt_data->assessmentattempt_id) !!}--}}
            {{--{!! Form::hidden('assessment_id', $assessment->assessment_id) !!}--}}
            <a href="{{ route('s_viewAllAssessment') }}" class="btn btn-default btn-block btn-flat btn-lg">Back to Assessment List</a>
            {{--                    {!! Form::submit('Edit Answers', array('class' => 'btn btn-primary btn-block btn-flat btn-lg')) !!}--}}
        </div>
        {{--<div class="col-xs-3">--}}
            {{--{!! Form::hidden('assessmentattempt_id', $attempt_data->assessmentattempt_id) !!}--}}
            {{--{!! Form::hidden('assessment_id', $assessment->assessment_id) !!}--}}
            {{--<a href="{{ route('studentAssessmentDone.show', $assessmentAttemptData->assessmentattempt_id) }}" class="btn btn-success btn-block btn-flat btn-lg">Save & Submit Answers</a>--}}

            {{--{!! Form::submit('Submit Answers', array('class' => 'btn btn-success btn-block btn-flat btn-lg')) !!}--}}
        {{--</div>--}}
        <label class="col-sm-4"></label>

    </div>
    <!-- /.row -->
    {!! Form::close() !!}
@endif
    {{--<br><br>--}}

    <!-- this row will not appear when printing -->
    {{--<div class="row no-print">--}}
        {{--<div class="col-xs-12">--}}
            {{--<span class="pull-right">--}}
                {{--<a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>--}}
            {{--</span>--}}
            {{--<button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment--}}
            {{--</button>--}}
            {{--<button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">--}}
                {{--<i class="fa fa-download"></i> Generate PDF--}}
            {{--</button>--}}
        {{--</div>--}}
    {{--</div>--}}
</section>
<!-- /.content -->
<div class="clearfix"></div>
{{--</div>--}}
@stop()
